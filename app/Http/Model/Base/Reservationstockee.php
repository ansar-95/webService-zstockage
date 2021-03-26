<?php

namespace App\Http\Model\Base;

use \DateTime;
use \Exception;
use \PDO;
use App\Http\Model\Pile as ChildPile;
use App\Http\Model\PileQuery as ChildPileQuery;
use App\Http\Model\Reservation as ChildReservation;
use App\Http\Model\ReservationQuery as ChildReservationQuery;
use App\Http\Model\ReservationstockeeQuery as ChildReservationstockeeQuery;
use App\Http\Model\Map\ReservationstockeeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'reservationStockee' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Reservationstockee implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Http\\Model\\Map\\ReservationstockeeTableMap';


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
     * The value for the idreservation field.
     *
     * @var        int
     */
    protected $idreservation;

    /**
     * The value for the emplacementdepart field.
     *
     * @var        int
     */
    protected $emplacementdepart;

    /**
     * The value for the quantite field.
     *
     * @var        int
     */
    protected $quantite;

    /**
     * The value for the datedebuteffective field.
     *
     * @var        DateTime
     */
    protected $datedebuteffective;

    /**
     * The value for the datefineffective field.
     *
     * @var        DateTime
     */
    protected $datefineffective;

    /**
     * @var        ChildReservation
     */
    protected $aReservation;

    /**
     * @var        ChildPile
     */
    protected $aPile;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of App\Http\Model\Base\Reservationstockee object.
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
     * Compares this with another <code>Reservationstockee</code> instance.  If
     * <code>obj</code> is an instance of <code>Reservationstockee</code>, delegates to
     * <code>equals(Reservationstockee)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [idreservation] column value.
     *
     * @return int
     */
    public function getIdreservation()
    {
        return $this->idreservation;
    }

    /**
     * Get the [emplacementdepart] column value.
     *
     * @return int
     */
    public function getEmplacementdepart()
    {
        return $this->emplacementdepart;
    }

    /**
     * Get the [quantite] column value.
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Get the [optionally formatted] temporal [datedebuteffective] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getDatedebuteffective($format = null)
    {
        if ($format === null) {
            return $this->datedebuteffective;
        } else {
            return $this->datedebuteffective instanceof \DateTimeInterface ? $this->datedebuteffective->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [datefineffective] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getDatefineffective($format = null)
    {
        if ($format === null) {
            return $this->datefineffective;
        } else {
            return $this->datefineffective instanceof \DateTimeInterface ? $this->datefineffective->format($format) : null;
        }
    }

    /**
     * Set the value of [numpile] column.
     *
     * @param string $v New value
     * @return $this|\App\Http\Model\Reservationstockee The current object (for fluent API support)
     */
    public function setNumpile($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->numpile !== $v) {
            $this->numpile = $v;
            $this->modifiedColumns[ReservationstockeeTableMap::COL_NUMPILE] = true;
        }

        if ($this->aPile !== null && $this->aPile->getNumpile() !== $v) {
            $this->aPile = null;
        }

        return $this;
    } // setNumpile()

    /**
     * Set the value of [numtravee] column.
     *
     * @param string $v New value
     * @return $this|\App\Http\Model\Reservationstockee The current object (for fluent API support)
     */
    public function setNumtravee($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->numtravee !== $v) {
            $this->numtravee = $v;
            $this->modifiedColumns[ReservationstockeeTableMap::COL_NUMTRAVEE] = true;
        }

        if ($this->aPile !== null && $this->aPile->getNumtravee() !== $v) {
            $this->aPile = null;
        }

        return $this;
    } // setNumtravee()

    /**
     * Set the value of [codebloc] column.
     *
     * @param string $v New value
     * @return $this|\App\Http\Model\Reservationstockee The current object (for fluent API support)
     */
    public function setCodebloc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->codebloc !== $v) {
            $this->codebloc = $v;
            $this->modifiedColumns[ReservationstockeeTableMap::COL_CODEBLOC] = true;
        }

        if ($this->aPile !== null && $this->aPile->getCodebloc() !== $v) {
            $this->aPile = null;
        }

        return $this;
    } // setCodebloc()

    /**
     * Set the value of [idreservation] column.
     *
     * @param int $v New value
     * @return $this|\App\Http\Model\Reservationstockee The current object (for fluent API support)
     */
    public function setIdreservation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idreservation !== $v) {
            $this->idreservation = $v;
            $this->modifiedColumns[ReservationstockeeTableMap::COL_IDRESERVATION] = true;
        }

        if ($this->aReservation !== null && $this->aReservation->getId() !== $v) {
            $this->aReservation = null;
        }

        return $this;
    } // setIdreservation()

    /**
     * Set the value of [emplacementdepart] column.
     *
     * @param int $v New value
     * @return $this|\App\Http\Model\Reservationstockee The current object (for fluent API support)
     */
    public function setEmplacementdepart($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->emplacementdepart !== $v) {
            $this->emplacementdepart = $v;
            $this->modifiedColumns[ReservationstockeeTableMap::COL_EMPLACEMENTDEPART] = true;
        }

        return $this;
    } // setEmplacementdepart()

    /**
     * Set the value of [quantite] column.
     *
     * @param int $v New value
     * @return $this|\App\Http\Model\Reservationstockee The current object (for fluent API support)
     */
    public function setQuantite($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->quantite !== $v) {
            $this->quantite = $v;
            $this->modifiedColumns[ReservationstockeeTableMap::COL_QUANTITE] = true;
        }

        return $this;
    } // setQuantite()

    /**
     * Sets the value of [datedebuteffective] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Http\Model\Reservationstockee The current object (for fluent API support)
     */
    public function setDatedebuteffective($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->datedebuteffective !== null || $dt !== null) {
            if ($this->datedebuteffective === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->datedebuteffective->format("Y-m-d H:i:s.u")) {
                $this->datedebuteffective = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ReservationstockeeTableMap::COL_DATEDEBUTEFFECTIVE] = true;
            }
        } // if either are not null

        return $this;
    } // setDatedebuteffective()

    /**
     * Sets the value of [datefineffective] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Http\Model\Reservationstockee The current object (for fluent API support)
     */
    public function setDatefineffective($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->datefineffective !== null || $dt !== null) {
            if ($this->datefineffective === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->datefineffective->format("Y-m-d H:i:s.u")) {
                $this->datefineffective = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ReservationstockeeTableMap::COL_DATEFINEFFECTIVE] = true;
            }
        } // if either are not null

        return $this;
    } // setDatefineffective()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ReservationstockeeTableMap::translateFieldName('Numpile', TableMap::TYPE_PHPNAME, $indexType)];
            $this->numpile = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ReservationstockeeTableMap::translateFieldName('Numtravee', TableMap::TYPE_PHPNAME, $indexType)];
            $this->numtravee = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ReservationstockeeTableMap::translateFieldName('Codebloc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codebloc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ReservationstockeeTableMap::translateFieldName('Idreservation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idreservation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ReservationstockeeTableMap::translateFieldName('Emplacementdepart', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emplacementdepart = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ReservationstockeeTableMap::translateFieldName('Quantite', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quantite = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ReservationstockeeTableMap::translateFieldName('Datedebuteffective', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->datedebuteffective = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ReservationstockeeTableMap::translateFieldName('Datefineffective', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->datefineffective = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = ReservationstockeeTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Http\\Model\\Reservationstockee'), 0, $e);
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
        if ($this->aPile !== null && $this->numpile !== $this->aPile->getNumpile()) {
            $this->aPile = null;
        }
        if ($this->aPile !== null && $this->numtravee !== $this->aPile->getNumtravee()) {
            $this->aPile = null;
        }
        if ($this->aPile !== null && $this->codebloc !== $this->aPile->getCodebloc()) {
            $this->aPile = null;
        }
        if ($this->aReservation !== null && $this->idreservation !== $this->aReservation->getId()) {
            $this->aReservation = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ReservationstockeeTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildReservationstockeeQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aReservation = null;
            $this->aPile = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Reservationstockee::setDeleted()
     * @see Reservationstockee::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReservationstockeeTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildReservationstockeeQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ReservationstockeeTableMap::DATABASE_NAME);
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
                ReservationstockeeTableMap::addInstanceToPool($this);
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

            if ($this->aReservation !== null) {
                if ($this->aReservation->isModified() || $this->aReservation->isNew()) {
                    $affectedRows += $this->aReservation->save($con);
                }
                $this->setReservation($this->aReservation);
            }

            if ($this->aPile !== null) {
                if ($this->aPile->isModified() || $this->aPile->isNew()) {
                    $affectedRows += $this->aPile->save($con);
                }
                $this->setPile($this->aPile);
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
        if ($this->isColumnModified(ReservationstockeeTableMap::COL_NUMPILE)) {
            $modifiedColumns[':p' . $index++]  = 'numPile';
        }
        if ($this->isColumnModified(ReservationstockeeTableMap::COL_NUMTRAVEE)) {
            $modifiedColumns[':p' . $index++]  = 'numTravee';
        }
        if ($this->isColumnModified(ReservationstockeeTableMap::COL_CODEBLOC)) {
            $modifiedColumns[':p' . $index++]  = 'codeBloc';
        }
        if ($this->isColumnModified(ReservationstockeeTableMap::COL_IDRESERVATION)) {
            $modifiedColumns[':p' . $index++]  = 'idReservation';
        }
        if ($this->isColumnModified(ReservationstockeeTableMap::COL_EMPLACEMENTDEPART)) {
            $modifiedColumns[':p' . $index++]  = 'emplacementDepart';
        }
        if ($this->isColumnModified(ReservationstockeeTableMap::COL_QUANTITE)) {
            $modifiedColumns[':p' . $index++]  = 'quantite';
        }
        if ($this->isColumnModified(ReservationstockeeTableMap::COL_DATEDEBUTEFFECTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'dateDebutEffective';
        }
        if ($this->isColumnModified(ReservationstockeeTableMap::COL_DATEFINEFFECTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'dateFinEffective';
        }

        $sql = sprintf(
            'INSERT INTO reservationStockee (%s) VALUES (%s)',
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
                    case 'idReservation':
                        $stmt->bindValue($identifier, $this->idreservation, PDO::PARAM_INT);
                        break;
                    case 'emplacementDepart':
                        $stmt->bindValue($identifier, $this->emplacementdepart, PDO::PARAM_INT);
                        break;
                    case 'quantite':
                        $stmt->bindValue($identifier, $this->quantite, PDO::PARAM_INT);
                        break;
                    case 'dateDebutEffective':
                        $stmt->bindValue($identifier, $this->datedebuteffective ? $this->datedebuteffective->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'dateFinEffective':
                        $stmt->bindValue($identifier, $this->datefineffective ? $this->datefineffective->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
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
        $pos = ReservationstockeeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdreservation();
                break;
            case 4:
                return $this->getEmplacementdepart();
                break;
            case 5:
                return $this->getQuantite();
                break;
            case 6:
                return $this->getDatedebuteffective();
                break;
            case 7:
                return $this->getDatefineffective();
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

        if (isset($alreadyDumpedObjects['Reservationstockee'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Reservationstockee'][$this->hashCode()] = true;
        $keys = ReservationstockeeTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getNumpile(),
            $keys[1] => $this->getNumtravee(),
            $keys[2] => $this->getCodebloc(),
            $keys[3] => $this->getIdreservation(),
            $keys[4] => $this->getEmplacementdepart(),
            $keys[5] => $this->getQuantite(),
            $keys[6] => $this->getDatedebuteffective(),
            $keys[7] => $this->getDatefineffective(),
        );
        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aReservation) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'reservation';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'reservation';
                        break;
                    default:
                        $key = 'Reservation';
                }

                $result[$key] = $this->aReservation->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPile) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pile';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pile';
                        break;
                    default:
                        $key = 'Pile';
                }

                $result[$key] = $this->aPile->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\App\Http\Model\Reservationstockee
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ReservationstockeeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Http\Model\Reservationstockee
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
                $this->setIdreservation($value);
                break;
            case 4:
                $this->setEmplacementdepart($value);
                break;
            case 5:
                $this->setQuantite($value);
                break;
            case 6:
                $this->setDatedebuteffective($value);
                break;
            case 7:
                $this->setDatefineffective($value);
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
        $keys = ReservationstockeeTableMap::getFieldNames($keyType);

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
            $this->setIdreservation($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setEmplacementdepart($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setQuantite($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDatedebuteffective($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDatefineffective($arr[$keys[7]]);
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
     * @return $this|\App\Http\Model\Reservationstockee The current object, for fluid interface
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
        $criteria = new Criteria(ReservationstockeeTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ReservationstockeeTableMap::COL_NUMPILE)) {
            $criteria->add(ReservationstockeeTableMap::COL_NUMPILE, $this->numpile);
        }
        if ($this->isColumnModified(ReservationstockeeTableMap::COL_NUMTRAVEE)) {
            $criteria->add(ReservationstockeeTableMap::COL_NUMTRAVEE, $this->numtravee);
        }
        if ($this->isColumnModified(ReservationstockeeTableMap::COL_CODEBLOC)) {
            $criteria->add(ReservationstockeeTableMap::COL_CODEBLOC, $this->codebloc);
        }
        if ($this->isColumnModified(ReservationstockeeTableMap::COL_IDRESERVATION)) {
            $criteria->add(ReservationstockeeTableMap::COL_IDRESERVATION, $this->idreservation);
        }
        if ($this->isColumnModified(ReservationstockeeTableMap::COL_EMPLACEMENTDEPART)) {
            $criteria->add(ReservationstockeeTableMap::COL_EMPLACEMENTDEPART, $this->emplacementdepart);
        }
        if ($this->isColumnModified(ReservationstockeeTableMap::COL_QUANTITE)) {
            $criteria->add(ReservationstockeeTableMap::COL_QUANTITE, $this->quantite);
        }
        if ($this->isColumnModified(ReservationstockeeTableMap::COL_DATEDEBUTEFFECTIVE)) {
            $criteria->add(ReservationstockeeTableMap::COL_DATEDEBUTEFFECTIVE, $this->datedebuteffective);
        }
        if ($this->isColumnModified(ReservationstockeeTableMap::COL_DATEFINEFFECTIVE)) {
            $criteria->add(ReservationstockeeTableMap::COL_DATEFINEFFECTIVE, $this->datefineffective);
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
        $criteria = ChildReservationstockeeQuery::create();
        $criteria->add(ReservationstockeeTableMap::COL_NUMPILE, $this->numpile);
        $criteria->add(ReservationstockeeTableMap::COL_NUMTRAVEE, $this->numtravee);
        $criteria->add(ReservationstockeeTableMap::COL_CODEBLOC, $this->codebloc);
        $criteria->add(ReservationstockeeTableMap::COL_IDRESERVATION, $this->idreservation);

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
            null !== $this->getCodebloc() &&
            null !== $this->getIdreservation();

        $validPrimaryKeyFKs = 4;
        $primaryKeyFKs = [];

        //relation reservationStockee_ibfk_1 to table reservation
        if ($this->aReservation && $hash = spl_object_hash($this->aReservation)) {
            $primaryKeyFKs[] = $hash;
        } else {
            $validPrimaryKeyFKs = false;
        }

        //relation reservationStockee_ibfk_2 to table pile
        if ($this->aPile && $hash = spl_object_hash($this->aPile)) {
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
        $pks[3] = $this->getIdreservation();

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
        $this->setIdreservation($keys[3]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return (null === $this->getNumpile()) && (null === $this->getNumtravee()) && (null === $this->getCodebloc()) && (null === $this->getIdreservation());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Http\Model\Reservationstockee (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNumpile($this->getNumpile());
        $copyObj->setNumtravee($this->getNumtravee());
        $copyObj->setCodebloc($this->getCodebloc());
        $copyObj->setIdreservation($this->getIdreservation());
        $copyObj->setEmplacementdepart($this->getEmplacementdepart());
        $copyObj->setQuantite($this->getQuantite());
        $copyObj->setDatedebuteffective($this->getDatedebuteffective());
        $copyObj->setDatefineffective($this->getDatefineffective());
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
     * @return \App\Http\Model\Reservationstockee Clone of current object.
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
     * Declares an association between this object and a ChildReservation object.
     *
     * @param  ChildReservation $v
     * @return $this|\App\Http\Model\Reservationstockee The current object (for fluent API support)
     * @throws PropelException
     */
    public function setReservation(ChildReservation $v = null)
    {
        if ($v === null) {
            $this->setIdreservation(NULL);
        } else {
            $this->setIdreservation($v->getId());
        }

        $this->aReservation = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildReservation object, it will not be re-added.
        if ($v !== null) {
            $v->addReservationstockee($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildReservation object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildReservation The associated ChildReservation object.
     * @throws PropelException
     */
    public function getReservation(ConnectionInterface $con = null)
    {
        if ($this->aReservation === null && ($this->idreservation != 0)) {
            $this->aReservation = ChildReservationQuery::create()->findPk($this->idreservation, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aReservation->addReservationstockees($this);
             */
        }

        return $this->aReservation;
    }

    /**
     * Declares an association between this object and a ChildPile object.
     *
     * @param  ChildPile $v
     * @return $this|\App\Http\Model\Reservationstockee The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPile(ChildPile $v = null)
    {
        if ($v === null) {
            $this->setNumpile(NULL);
        } else {
            $this->setNumpile($v->getNumpile());
        }

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

        $this->aPile = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPile object, it will not be re-added.
        if ($v !== null) {
            $v->addReservationstockee($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPile object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPile The associated ChildPile object.
     * @throws PropelException
     */
    public function getPile(ConnectionInterface $con = null)
    {
        if ($this->aPile === null && (($this->numpile !== "" && $this->numpile !== null) && ($this->numtravee !== "" && $this->numtravee !== null) && ($this->codebloc !== "" && $this->codebloc !== null))) {
            $this->aPile = ChildPileQuery::create()->findPk(array($this->numpile, $this->numtravee, $this->codebloc), $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPile->addReservationstockees($this);
             */
        }

        return $this->aPile;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aReservation) {
            $this->aReservation->removeReservationstockee($this);
        }
        if (null !== $this->aPile) {
            $this->aPile->removeReservationstockee($this);
        }
        $this->numpile = null;
        $this->numtravee = null;
        $this->codebloc = null;
        $this->idreservation = null;
        $this->emplacementdepart = null;
        $this->quantite = null;
        $this->datedebuteffective = null;
        $this->datefineffective = null;
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
        } // if ($deep)

        $this->aReservation = null;
        $this->aPile = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ReservationstockeeTableMap::DEFAULT_STRING_FORMAT);
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
