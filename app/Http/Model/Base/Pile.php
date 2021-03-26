<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Pile as ChildPile;
use App\Http\Model\PileQuery as ChildPileQuery;
use App\Http\Model\Reservationstockee as ChildReservationstockee;
use App\Http\Model\ReservationstockeeQuery as ChildReservationstockeeQuery;
use App\Http\Model\Travee as ChildTravee;
use App\Http\Model\TraveeQuery as ChildTraveeQuery;
use App\Http\Model\Map\PileTableMap;
use App\Http\Model\Map\ReservationstockeeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'pile' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Pile implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Http\\Model\\Map\\PileTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the numpile field.
     *
     * @var        string
     */
    protected $numpile;

    /**
     * The value for the numtravee field.
     *
     * @var        string
     */
    protected $numtravee;

    /**
     * The value for the codebloc field.
     *
     * @var        string
     */
    protected $codebloc;

    /**
     * The value for the capacite field.
     *
     * @var        int
     */
    protected $capacite;

    /**
     * @var        ChildTravee
     */
    protected $aTravee;

    /**
     * @var        ObjectCollection|ChildReservationstockee[] Collection to store aggregation of ChildReservationstockee objects.
     */
    protected $collReservationstockees;
    protected $collReservationstockeesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildReservationstockee[]
     */
    protected $reservationstockeesScheduledForDeletion = null;

    /**
     * Initializes internal state of App\Http\Model\Base\Pile object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Pile</code> instance.  If
     * <code>obj</code> is an instance of <code>Pile</code>, delegates to
     * <code>equals(Pile)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [numpile] column value.
     *
     * @return string
     */
    public function getNumpile()
    {
        return $this->numpile;
    }

    /**
     * Get the [numtravee] column value.
     *
     * @return string
     */
    public function getNumtravee()
    {
        return $this->numtravee;
    }

    /**
     * Get the [codebloc] column value.
     *
     * @return string
     */
    public function getCodebloc()
    {
        return $this->codebloc;
    }

    /**
     * Get the [capacite] column value.
     *
     * @return int
     */
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * Set the value of [numpile] column.
     *
     * @param string $v New value
     * @return $this|\App\Http\Model\Pile The current object (for fluent API support)
     */
    public function setNumpile($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->numpile !== $v) {
            $this->numpile = $v;
            $this->modifiedColumns[PileTableMap::COL_NUMPILE] = true;
        }

        return $this;
    } // setNumpile()

    /**
     * Set the value of [numtravee] column.
     *
     * @param string $v New value
     * @return $this|\App\Http\Model\Pile The current object (for fluent API support)
     */
    public function setNumtravee($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->numtravee !== $v) {
            $this->numtravee = $v;
            $this->modifiedColumns[PileTableMap::COL_NUMTRAVEE] = true;
        }

        if ($this->aTravee !== null && $this->aTravee->getNumtravee() !== $v) {
            $this->aTravee = null;
        }

        return $this;
    } // setNumtravee()

    /**
     * Set the value of [codebloc] column.
     *
     * @param string $v New value
     * @return $this|\App\Http\Model\Pile The current object (for fluent API support)
     */
    public function setCodebloc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->codebloc !== $v) {
            $this->codebloc = $v;
            $this->modifiedColumns[PileTableMap::COL_CODEBLOC] = true;
        }

        if ($this->aTravee !== null && $this->aTravee->getCodebloc() !== $v) {
            $this->aTravee = null;
        }

        return $this;
    } // setCodebloc()

    /**
     * Set the value of [capacite] column.
     *
     * @param int $v New value
     * @return $this|\App\Http\Model\Pile The current object (for fluent API support)
     */
    public function setCapacite($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->capacite !== $v) {
            $this->capacite = $v;
            $this->modifiedColumns[PileTableMap::COL_CAPACITE] = true;
        }

        return $this;
    } // setCapacite()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PileTableMap::translateFieldName('Numpile', TableMap::TYPE_PHPNAME, $indexType)];
            $this->numpile = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PileTableMap::translateFieldName('Numtravee', TableMap::TYPE_PHPNAME, $indexType)];
            $this->numtravee = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PileTableMap::translateFieldName('Codebloc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codebloc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PileTableMap::translateFieldName('Capacite', TableMap::TYPE_PHPNAME, $indexType)];
            $this->capacite = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = PileTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Http\\Model\\Pile'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aTravee !== null && $this->numtravee !== $this->aTravee->getNumtravee()) {
            $this->aTravee = null;
        }
        if ($this->aTravee !== null && $this->codebloc !== $this->aTravee->getCodebloc()) {
            $this->aTravee = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PileTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPileQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTravee = null;
            $this->collReservationstockees = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Pile::setDeleted()
     * @see Pile::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PileTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPileQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PileTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                PileTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aTravee !== null) {
                if ($this->aTravee->isModified() || $this->aTravee->isNew()) {
                    $affectedRows += $this->aTravee->save($con);
                }
                $this->setTravee($this->aTravee);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->reservationstockeesScheduledForDeletion !== null) {
                if (!$this->reservationstockeesScheduledForDeletion->isEmpty()) {
                    \App\Http\Model\ReservationstockeeQuery::create()
                        ->filterByPrimaryKeys($this->reservationstockeesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->reservationstockeesScheduledForDeletion = null;
                }
            }

            if ($this->collReservationstockees !== null) {
                foreach ($this->collReservationstockees as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PileTableMap::COL_NUMPILE)) {
            $modifiedColumns[':p' . $index++]  = 'numPile';
        }
        if ($this->isColumnModified(PileTableMap::COL_NUMTRAVEE)) {
            $modifiedColumns[':p' . $index++]  = 'numTravee';
        }
        if ($this->isColumnModified(PileTableMap::COL_CODEBLOC)) {
            $modifiedColumns[':p' . $index++]  = 'codeBloc';
        }
        if ($this->isColumnModified(PileTableMap::COL_CAPACITE)) {
            $modifiedColumns[':p' . $index++]  = 'capacite';
        }

        $sql = sprintf(
            'INSERT INTO pile (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'numPile':
                        $stmt->bindValue($identifier, $this->numpile, PDO::PARAM_STR);
                        break;
                    case 'numTravee':
                        $stmt->bindValue($identifier, $this->numtravee, PDO::PARAM_STR);
                        break;
                    case 'codeBloc':
                        $stmt->bindValue($identifier, $this->codebloc, PDO::PARAM_STR);
                        break;
                    case 'capacite':
                        $stmt->bindValue($identifier, $this->capacite, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PileTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getNumpile();
                break;
            case 1:
                return $this->getNumtravee();
                break;
            case 2:
                return $this->getCodebloc();
                break;
            case 3:
                return $this->getCapacite();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Pile'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Pile'][$this->hashCode()] = true;
        $keys = PileTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getNumpile(),
            $keys[1] => $this->getNumtravee(),
            $keys[2] => $this->getCodebloc(),
            $keys[3] => $this->getCapacite(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aTravee) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'travee';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'travee';
                        break;
                    default:
                        $key = 'Travee';
                }

                $result[$key] = $this->aTravee->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collReservationstockees) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'reservationstockees';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'reservationStockees';
                        break;
                    default:
                        $key = 'Reservationstockees';
                }

                $result[$key] = $this->collReservationstockees->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\App\Http\Model\Pile
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PileTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Http\Model\Pile
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setNumpile($value);
                break;
            case 1:
                $this->setNumtravee($value);
                break;
            case 2:
                $this->setCodebloc($value);
                break;
            case 3:
                $this->setCapacite($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = PileTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setNumpile($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNumtravee($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCodebloc($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCapacite($arr[$keys[3]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\App\Http\Model\Pile The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PileTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PileTableMap::COL_NUMPILE)) {
            $criteria->add(PileTableMap::COL_NUMPILE, $this->numpile);
        }
        if ($this->isColumnModified(PileTableMap::COL_NUMTRAVEE)) {
            $criteria->add(PileTableMap::COL_NUMTRAVEE, $this->numtravee);
        }
        if ($this->isColumnModified(PileTableMap::COL_CODEBLOC)) {
            $criteria->add(PileTableMap::COL_CODEBLOC, $this->codebloc);
        }
        if ($this->isColumnModified(PileTableMap::COL_CAPACITE)) {
            $criteria->add(PileTableMap::COL_CAPACITE, $this->capacite);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildPileQuery::create();
        $criteria->add(PileTableMap::COL_NUMPILE, $this->numpile);
        $criteria->add(PileTableMap::COL_NUMTRAVEE, $this->numtravee);
        $criteria->add(PileTableMap::COL_CODEBLOC, $this->codebloc);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getNumpile() &&
            null !== $this->getNumtravee() &&
            null !== $this->getCodebloc();

        $validPrimaryKeyFKs = 2;
        $primaryKeyFKs = [];

        //relation pile_ibfk to table travee
        if ($this->aTravee && $hash = spl_object_hash($this->aTravee)) {
            $primaryKeyFKs[] = $hash;
        } else {
            $validPrimaryKeyFKs = false;
        }

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the composite primary key for this object.
     * The array elements will be in same order as specified in XML.
     * @return array
     */
    public function getPrimaryKey()
    {
        $pks = array();
        $pks[0] = $this->getNumpile();
        $pks[1] = $this->getNumtravee();
        $pks[2] = $this->getCodebloc();

        return $pks;
    }

    /**
     * Set the [composite] primary key.
     *
     * @param      array $keys The elements of the composite key (order must match the order in XML file).
     * @return void
     */
    public function setPrimaryKey($keys)
    {
        $this->setNumpile($keys[0]);
        $this->setNumtravee($keys[1]);
        $this->setCodebloc($keys[2]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return (null === $this->getNumpile()) && (null === $this->getNumtravee()) && (null === $this->getCodebloc());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Http\Model\Pile (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNumpile($this->getNumpile());
        $copyObj->setNumtravee($this->getNumtravee());
        $copyObj->setCodebloc($this->getCodebloc());
        $copyObj->setCapacite($this->getCapacite());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getReservationstockees() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addReservationstockee($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \App\Http\Model\Pile Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildTravee object.
     *
     * @param  ChildTravee $v
     * @return $this|\App\Http\Model\Pile The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTravee(ChildTravee $v = null)
    {
        if ($v === null) {
            $this->setNumtravee(NULL);
        } else {
            $this->setNumtravee($v->getNumtravee());
        }

        if ($v === null) {
            $this->setCodebloc(NULL);
        } else {
            $this->setCodebloc($v->getCodebloc());
        }

        $this->aTravee = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildTravee object, it will not be re-added.
        if ($v !== null) {
            $v->addPile($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildTravee object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildTravee The associated ChildTravee object.
     * @throws PropelException
     */
    public function getTravee(ConnectionInterface $con = null)
    {
        if ($this->aTravee === null && (($this->numtravee !== "" && $this->numtravee !== null) && ($this->codebloc !== "" && $this->codebloc !== null))) {
            $this->aTravee = ChildTraveeQuery::create()->findPk(array($this->numtravee, $this->codebloc), $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTravee->addPiles($this);
             */
        }

        return $this->aTravee;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Reservationstockee' === $relationName) {
            $this->initReservationstockees();
            return;
        }
    }

    /**
     * Clears out the collReservationstockees collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addReservationstockees()
     */
    public function clearReservationstockees()
    {
        $this->collReservationstockees = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collReservationstockees collection loaded partially.
     */
    public function resetPartialReservationstockees($v = true)
    {
        $this->collReservationstockeesPartial = $v;
    }

    /**
     * Initializes the collReservationstockees collection.
     *
     * By default this just sets the collReservationstockees collection to an empty array (like clearcollReservationstockees());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initReservationstockees($overrideExisting = true)
    {
        if (null !== $this->collReservationstockees && !$overrideExisting) {
            return;
        }

        $collectionClassName = ReservationstockeeTableMap::getTableMap()->getCollectionClassName();

        $this->collReservationstockees = new $collectionClassName;
        $this->collReservationstockees->setModel('\App\Http\Model\Reservationstockee');
    }

    /**
     * Gets an array of ChildReservationstockee objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPile is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildReservationstockee[] List of ChildReservationstockee objects
     * @throws PropelException
     */
    public function getReservationstockees(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collReservationstockeesPartial && !$this->isNew();
        if (null === $this->collReservationstockees || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collReservationstockees) {
                    $this->initReservationstockees();
                } else {
                    $collectionClassName = ReservationstockeeTableMap::getTableMap()->getCollectionClassName();

                    $collReservationstockees = new $collectionClassName;
                    $collReservationstockees->setModel('\App\Http\Model\Reservationstockee');

                    return $collReservationstockees;
                }
            } else {
                $collReservationstockees = ChildReservationstockeeQuery::create(null, $criteria)
                    ->filterByPile($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collReservationstockeesPartial && count($collReservationstockees)) {
                        $this->initReservationstockees(false);

                        foreach ($collReservationstockees as $obj) {
                            if (false == $this->collReservationstockees->contains($obj)) {
                                $this->collReservationstockees->append($obj);
                            }
                        }

                        $this->collReservationstockeesPartial = true;
                    }

                    return $collReservationstockees;
                }

                if ($partial && $this->collReservationstockees) {
                    foreach ($this->collReservationstockees as $obj) {
                        if ($obj->isNew()) {
                            $collReservationstockees[] = $obj;
                        }
                    }
                }

                $this->collReservationstockees = $collReservationstockees;
                $this->collReservationstockeesPartial = false;
            }
        }

        return $this->collReservationstockees;
    }

    /**
     * Sets a collection of ChildReservationstockee objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $reservationstockees A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPile The current object (for fluent API support)
     */
    public function setReservationstockees(Collection $reservationstockees, ConnectionInterface $con = null)
    {
        /** @var ChildReservationstockee[] $reservationstockeesToDelete */
        $reservationstockeesToDelete = $this->getReservationstockees(new Criteria(), $con)->diff($reservationstockees);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->reservationstockeesScheduledForDeletion = clone $reservationstockeesToDelete;

        foreach ($reservationstockeesToDelete as $reservationstockeeRemoved) {
            $reservationstockeeRemoved->setPile(null);
        }

        $this->collReservationstockees = null;
        foreach ($reservationstockees as $reservationstockee) {
            $this->addReservationstockee($reservationstockee);
        }

        $this->collReservationstockees = $reservationstockees;
        $this->collReservationstockeesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Reservationstockee objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Reservationstockee objects.
     * @throws PropelException
     */
    public function countReservationstockees(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collReservationstockeesPartial && !$this->isNew();
        if (null === $this->collReservationstockees || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collReservationstockees) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getReservationstockees());
            }

            $query = ChildReservationstockeeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPile($this)
                ->count($con);
        }

        return count($this->collReservationstockees);
    }

    /**
     * Method called to associate a ChildReservationstockee object to this object
     * through the ChildReservationstockee foreign key attribute.
     *
     * @param  ChildReservationstockee $l ChildReservationstockee
     * @return $this|\App\Http\Model\Pile The current object (for fluent API support)
     */
    public function addReservationstockee(ChildReservationstockee $l)
    {
        if ($this->collReservationstockees === null) {
            $this->initReservationstockees();
            $this->collReservationstockeesPartial = true;
        }

        if (!$this->collReservationstockees->contains($l)) {
            $this->doAddReservationstockee($l);

            if ($this->reservationstockeesScheduledForDeletion and $this->reservationstockeesScheduledForDeletion->contains($l)) {
                $this->reservationstockeesScheduledForDeletion->remove($this->reservationstockeesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildReservationstockee $reservationstockee The ChildReservationstockee object to add.
     */
    protected function doAddReservationstockee(ChildReservationstockee $reservationstockee)
    {
        $this->collReservationstockees[]= $reservationstockee;
        $reservationstockee->setPile($this);
    }

    /**
     * @param  ChildReservationstockee $reservationstockee The ChildReservationstockee object to remove.
     * @return $this|ChildPile The current object (for fluent API support)
     */
    public function removeReservationstockee(ChildReservationstockee $reservationstockee)
    {
        if ($this->getReservationstockees()->contains($reservationstockee)) {
            $pos = $this->collReservationstockees->search($reservationstockee);
            $this->collReservationstockees->remove($pos);
            if (null === $this->reservationstockeesScheduledForDeletion) {
                $this->reservationstockeesScheduledForDeletion = clone $this->collReservationstockees;
                $this->reservationstockeesScheduledForDeletion->clear();
            }
            $this->reservationstockeesScheduledForDeletion[]= clone $reservationstockee;
            $reservationstockee->setPile(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Pile is new, it will return
     * an empty collection; or if this Pile has previously
     * been saved, it will retrieve related Reservationstockees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Pile.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildReservationstockee[] List of ChildReservationstockee objects
     */
    public function getReservationstockeesJoinReservation(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildReservationstockeeQuery::create(null, $criteria);
        $query->joinWith('Reservation', $joinBehavior);

        return $this->getReservationstockees($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aTravee) {
            $this->aTravee->removePile($this);
        }
        $this->numpile = null;
        $this->numtravee = null;
        $this->codebloc = null;
        $this->capacite = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collReservationstockees) {
                foreach ($this->collReservationstockees as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collReservationstockees = null;
        $this->aTravee = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PileTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
