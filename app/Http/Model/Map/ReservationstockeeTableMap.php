<?php

namespace App\Http\Model\Map;

use App\Http\Model\Reservationstockee;
use App\Http\Model\ReservationstockeeQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'reservationStockee' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ReservationstockeeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ReservationstockeeTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'ws-zstockage-connection';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'reservationStockee';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Http\\Model\\Reservationstockee';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Reservationstockee';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the numPile field
     */
    const COL_NUMPILE = 'reservationStockee.numPile';

    /**
     * the column name for the numTravee field
     */
    const COL_NUMTRAVEE = 'reservationStockee.numTravee';

    /**
     * the column name for the codeBloc field
     */
    const COL_CODEBLOC = 'reservationStockee.codeBloc';

    /**
     * the column name for the idReservation field
     */
    const COL_IDRESERVATION = 'reservationStockee.idReservation';

    /**
     * the column name for the emplacementDepart field
     */
    const COL_EMPLACEMENTDEPART = 'reservationStockee.emplacementDepart';

    /**
     * the column name for the quantite field
     */
    const COL_QUANTITE = 'reservationStockee.quantite';

    /**
     * the column name for the dateDebutEffective field
     */
    const COL_DATEDEBUTEFFECTIVE = 'reservationStockee.dateDebutEffective';

    /**
     * the column name for the dateFinEffective field
     */
    const COL_DATEFINEFFECTIVE = 'reservationStockee.dateFinEffective';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Numpile', 'Numtravee', 'Codebloc', 'Idreservation', 'Emplacementdepart', 'Quantite', 'Datedebuteffective', 'Datefineffective', ),
        self::TYPE_CAMELNAME     => array('numpile', 'numtravee', 'codebloc', 'idreservation', 'emplacementdepart', 'quantite', 'datedebuteffective', 'datefineffective', ),
        self::TYPE_COLNAME       => array(ReservationstockeeTableMap::COL_NUMPILE, ReservationstockeeTableMap::COL_NUMTRAVEE, ReservationstockeeTableMap::COL_CODEBLOC, ReservationstockeeTableMap::COL_IDRESERVATION, ReservationstockeeTableMap::COL_EMPLACEMENTDEPART, ReservationstockeeTableMap::COL_QUANTITE, ReservationstockeeTableMap::COL_DATEDEBUTEFFECTIVE, ReservationstockeeTableMap::COL_DATEFINEFFECTIVE, ),
        self::TYPE_FIELDNAME     => array('numPile', 'numTravee', 'codeBloc', 'idReservation', 'emplacementDepart', 'quantite', 'dateDebutEffective', 'dateFinEffective', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Numpile' => 0, 'Numtravee' => 1, 'Codebloc' => 2, 'Idreservation' => 3, 'Emplacementdepart' => 4, 'Quantite' => 5, 'Datedebuteffective' => 6, 'Datefineffective' => 7, ),
        self::TYPE_CAMELNAME     => array('numpile' => 0, 'numtravee' => 1, 'codebloc' => 2, 'idreservation' => 3, 'emplacementdepart' => 4, 'quantite' => 5, 'datedebuteffective' => 6, 'datefineffective' => 7, ),
        self::TYPE_COLNAME       => array(ReservationstockeeTableMap::COL_NUMPILE => 0, ReservationstockeeTableMap::COL_NUMTRAVEE => 1, ReservationstockeeTableMap::COL_CODEBLOC => 2, ReservationstockeeTableMap::COL_IDRESERVATION => 3, ReservationstockeeTableMap::COL_EMPLACEMENTDEPART => 4, ReservationstockeeTableMap::COL_QUANTITE => 5, ReservationstockeeTableMap::COL_DATEDEBUTEFFECTIVE => 6, ReservationstockeeTableMap::COL_DATEFINEFFECTIVE => 7, ),
        self::TYPE_FIELDNAME     => array('numPile' => 0, 'numTravee' => 1, 'codeBloc' => 2, 'idReservation' => 3, 'emplacementDepart' => 4, 'quantite' => 5, 'dateDebutEffective' => 6, 'dateFinEffective' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'Numpile' => 'NUMPILE',
        'Reservationstockee.Numpile' => 'NUMPILE',
        'numpile' => 'NUMPILE',
        'reservationstockee.numpile' => 'NUMPILE',
        'ReservationstockeeTableMap::COL_NUMPILE' => 'NUMPILE',
        'COL_NUMPILE' => 'NUMPILE',
        'numPile' => 'NUMPILE',
        'reservationStockee.numPile' => 'NUMPILE',
        'Numtravee' => 'NUMTRAVEE',
        'Reservationstockee.Numtravee' => 'NUMTRAVEE',
        'numtravee' => 'NUMTRAVEE',
        'reservationstockee.numtravee' => 'NUMTRAVEE',
        'ReservationstockeeTableMap::COL_NUMTRAVEE' => 'NUMTRAVEE',
        'COL_NUMTRAVEE' => 'NUMTRAVEE',
        'numTravee' => 'NUMTRAVEE',
        'reservationStockee.numTravee' => 'NUMTRAVEE',
        'Codebloc' => 'CODEBLOC',
        'Reservationstockee.Codebloc' => 'CODEBLOC',
        'codebloc' => 'CODEBLOC',
        'reservationstockee.codebloc' => 'CODEBLOC',
        'ReservationstockeeTableMap::COL_CODEBLOC' => 'CODEBLOC',
        'COL_CODEBLOC' => 'CODEBLOC',
        'codeBloc' => 'CODEBLOC',
        'reservationStockee.codeBloc' => 'CODEBLOC',
        'Idreservation' => 'IDRESERVATION',
        'Reservationstockee.Idreservation' => 'IDRESERVATION',
        'idreservation' => 'IDRESERVATION',
        'reservationstockee.idreservation' => 'IDRESERVATION',
        'ReservationstockeeTableMap::COL_IDRESERVATION' => 'IDRESERVATION',
        'COL_IDRESERVATION' => 'IDRESERVATION',
        'idReservation' => 'IDRESERVATION',
        'reservationStockee.idReservation' => 'IDRESERVATION',
        'Emplacementdepart' => 'EMPLACEMENTDEPART',
        'Reservationstockee.Emplacementdepart' => 'EMPLACEMENTDEPART',
        'emplacementdepart' => 'EMPLACEMENTDEPART',
        'reservationstockee.emplacementdepart' => 'EMPLACEMENTDEPART',
        'ReservationstockeeTableMap::COL_EMPLACEMENTDEPART' => 'EMPLACEMENTDEPART',
        'COL_EMPLACEMENTDEPART' => 'EMPLACEMENTDEPART',
        'emplacementDepart' => 'EMPLACEMENTDEPART',
        'reservationStockee.emplacementDepart' => 'EMPLACEMENTDEPART',
        'Quantite' => 'QUANTITE',
        'Reservationstockee.Quantite' => 'QUANTITE',
        'quantite' => 'QUANTITE',
        'reservationstockee.quantite' => 'QUANTITE',
        'ReservationstockeeTableMap::COL_QUANTITE' => 'QUANTITE',
        'COL_QUANTITE' => 'QUANTITE',
        'quantite' => 'QUANTITE',
        'reservationStockee.quantite' => 'QUANTITE',
        'Datedebuteffective' => 'DATEDEBUTEFFECTIVE',
        'Reservationstockee.Datedebuteffective' => 'DATEDEBUTEFFECTIVE',
        'datedebuteffective' => 'DATEDEBUTEFFECTIVE',
        'reservationstockee.datedebuteffective' => 'DATEDEBUTEFFECTIVE',
        'ReservationstockeeTableMap::COL_DATEDEBUTEFFECTIVE' => 'DATEDEBUTEFFECTIVE',
        'COL_DATEDEBUTEFFECTIVE' => 'DATEDEBUTEFFECTIVE',
        'dateDebutEffective' => 'DATEDEBUTEFFECTIVE',
        'reservationStockee.dateDebutEffective' => 'DATEDEBUTEFFECTIVE',
        'Datefineffective' => 'DATEFINEFFECTIVE',
        'Reservationstockee.Datefineffective' => 'DATEFINEFFECTIVE',
        'datefineffective' => 'DATEFINEFFECTIVE',
        'reservationstockee.datefineffective' => 'DATEFINEFFECTIVE',
        'ReservationstockeeTableMap::COL_DATEFINEFFECTIVE' => 'DATEFINEFFECTIVE',
        'COL_DATEFINEFFECTIVE' => 'DATEFINEFFECTIVE',
        'dateFinEffective' => 'DATEFINEFFECTIVE',
        'reservationStockee.dateFinEffective' => 'DATEFINEFFECTIVE',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('reservationStockee');
        $this->setPhpName('Reservationstockee');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Http\\Model\\Reservationstockee');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('numPile', 'Numpile', 'CHAR' , 'pile', 'numPile', true, null, null);
        $this->addForeignPrimaryKey('numTravee', 'Numtravee', 'CHAR' , 'pile', 'numTravee', true, null, null);
        $this->addForeignPrimaryKey('codeBloc', 'Codebloc', 'CHAR' , 'pile', 'codeBloc', true, null, null);
        $this->addForeignPrimaryKey('idReservation', 'Idreservation', 'INTEGER' , 'reservation', 'id', true, null, null);
        $this->addColumn('emplacementDepart', 'Emplacementdepart', 'INTEGER', true, null, null);
        $this->addColumn('quantite', 'Quantite', 'INTEGER', true, null, null);
        $this->addColumn('dateDebutEffective', 'Datedebuteffective', 'TIMESTAMP', true, null, null);
        $this->addColumn('dateFinEffective', 'Datefineffective', 'TIMESTAMP', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Reservation', '\\App\\Http\\Model\\Reservation', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':idReservation',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('Pile', '\\App\\Http\\Model\\Pile', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':numPile',
    1 => ':numPile',
  ),
  1 =>
  array (
    0 => ':numTravee',
    1 => ':numTravee',
  ),
  2 =>
  array (
    0 => ':codeBloc',
    1 => ':codeBloc',
  ),
), 'CASCADE', 'CASCADE', null, false);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \App\Http\Model\Reservationstockee $obj A \App\Http\Model\Reservationstockee object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getNumpile() || is_scalar($obj->getNumpile()) || is_callable([$obj->getNumpile(), '__toString']) ? (string) $obj->getNumpile() : $obj->getNumpile()), (null === $obj->getNumtravee() || is_scalar($obj->getNumtravee()) || is_callable([$obj->getNumtravee(), '__toString']) ? (string) $obj->getNumtravee() : $obj->getNumtravee()), (null === $obj->getCodebloc() || is_scalar($obj->getCodebloc()) || is_callable([$obj->getCodebloc(), '__toString']) ? (string) $obj->getCodebloc() : $obj->getCodebloc()), (null === $obj->getIdreservation() || is_scalar($obj->getIdreservation()) || is_callable([$obj->getIdreservation(), '__toString']) ? (string) $obj->getIdreservation() : $obj->getIdreservation())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \App\Http\Model\Reservationstockee object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \App\Http\Model\Reservationstockee) {
                $key = serialize([(null === $value->getNumpile() || is_scalar($value->getNumpile()) || is_callable([$value->getNumpile(), '__toString']) ? (string) $value->getNumpile() : $value->getNumpile()), (null === $value->getNumtravee() || is_scalar($value->getNumtravee()) || is_callable([$value->getNumtravee(), '__toString']) ? (string) $value->getNumtravee() : $value->getNumtravee()), (null === $value->getCodebloc() || is_scalar($value->getCodebloc()) || is_callable([$value->getCodebloc(), '__toString']) ? (string) $value->getCodebloc() : $value->getCodebloc()), (null === $value->getIdreservation() || is_scalar($value->getIdreservation()) || is_callable([$value->getIdreservation(), '__toString']) ? (string) $value->getIdreservation() : $value->getIdreservation())]);

            } elseif (is_array($value) && count($value) === 4) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1]), (null === $value[2] || is_scalar($value[2]) || is_callable([$value[2], '__toString']) ? (string) $value[2] : $value[2]), (null === $value[3] || is_scalar($value[3]) || is_callable([$value[3], '__toString']) ? (string) $value[3] : $value[3])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \App\Http\Model\Reservationstockee object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Numpile', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Numtravee', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Codebloc', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('Idreservation', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Numpile', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Numpile', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Numpile', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Numpile', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Numpile', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Numtravee', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Numtravee', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Numtravee', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Numtravee', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Numtravee', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Codebloc', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Codebloc', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Codebloc', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Codebloc', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Codebloc', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('Idreservation', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('Idreservation', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('Idreservation', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('Idreservation', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('Idreservation', TableMap::TYPE_PHPNAME, $indexType)])]);
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
            $pks = [];

        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Numpile', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('Numtravee', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 2 + $offset
                : self::translateFieldName('Codebloc', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 3 + $offset
                : self::translateFieldName('Idreservation', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? ReservationstockeeTableMap::CLASS_DEFAULT : ReservationstockeeTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Reservationstockee object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ReservationstockeeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ReservationstockeeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ReservationstockeeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ReservationstockeeTableMap::OM_CLASS;
            /** @var Reservationstockee $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ReservationstockeeTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = ReservationstockeeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ReservationstockeeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Reservationstockee $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ReservationstockeeTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ReservationstockeeTableMap::COL_NUMPILE);
            $criteria->addSelectColumn(ReservationstockeeTableMap::COL_NUMTRAVEE);
            $criteria->addSelectColumn(ReservationstockeeTableMap::COL_CODEBLOC);
            $criteria->addSelectColumn(ReservationstockeeTableMap::COL_IDRESERVATION);
            $criteria->addSelectColumn(ReservationstockeeTableMap::COL_EMPLACEMENTDEPART);
            $criteria->addSelectColumn(ReservationstockeeTableMap::COL_QUANTITE);
            $criteria->addSelectColumn(ReservationstockeeTableMap::COL_DATEDEBUTEFFECTIVE);
            $criteria->addSelectColumn(ReservationstockeeTableMap::COL_DATEFINEFFECTIVE);
        } else {
            $criteria->addSelectColumn($alias . '.numPile');
            $criteria->addSelectColumn($alias . '.numTravee');
            $criteria->addSelectColumn($alias . '.codeBloc');
            $criteria->addSelectColumn($alias . '.idReservation');
            $criteria->addSelectColumn($alias . '.emplacementDepart');
            $criteria->addSelectColumn($alias . '.quantite');
            $criteria->addSelectColumn($alias . '.dateDebutEffective');
            $criteria->addSelectColumn($alias . '.dateFinEffective');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria object containing the columns to remove.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function removeSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(ReservationstockeeTableMap::COL_NUMPILE);
            $criteria->removeSelectColumn(ReservationstockeeTableMap::COL_NUMTRAVEE);
            $criteria->removeSelectColumn(ReservationstockeeTableMap::COL_CODEBLOC);
            $criteria->removeSelectColumn(ReservationstockeeTableMap::COL_IDRESERVATION);
            $criteria->removeSelectColumn(ReservationstockeeTableMap::COL_EMPLACEMENTDEPART);
            $criteria->removeSelectColumn(ReservationstockeeTableMap::COL_QUANTITE);
            $criteria->removeSelectColumn(ReservationstockeeTableMap::COL_DATEDEBUTEFFECTIVE);
            $criteria->removeSelectColumn(ReservationstockeeTableMap::COL_DATEFINEFFECTIVE);
        } else {
            $criteria->removeSelectColumn($alias . '.numPile');
            $criteria->removeSelectColumn($alias . '.numTravee');
            $criteria->removeSelectColumn($alias . '.codeBloc');
            $criteria->removeSelectColumn($alias . '.idReservation');
            $criteria->removeSelectColumn($alias . '.emplacementDepart');
            $criteria->removeSelectColumn($alias . '.quantite');
            $criteria->removeSelectColumn($alias . '.dateDebutEffective');
            $criteria->removeSelectColumn($alias . '.dateFinEffective');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(ReservationstockeeTableMap::DATABASE_NAME)->getTable(ReservationstockeeTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ReservationstockeeTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ReservationstockeeTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ReservationstockeeTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Reservationstockee or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Reservationstockee object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReservationstockeeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Http\Model\Reservationstockee) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ReservationstockeeTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(ReservationstockeeTableMap::COL_NUMPILE, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(ReservationstockeeTableMap::COL_NUMTRAVEE, $value[1]));
                $criterion->addAnd($criteria->getNewCriterion(ReservationstockeeTableMap::COL_CODEBLOC, $value[2]));
                $criterion->addAnd($criteria->getNewCriterion(ReservationstockeeTableMap::COL_IDRESERVATION, $value[3]));
                $criteria->addOr($criterion);
            }
        }

        $query = ReservationstockeeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ReservationstockeeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ReservationstockeeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the reservationStockee table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ReservationstockeeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Reservationstockee or Criteria object.
     *
     * @param mixed               $criteria Criteria or Reservationstockee object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReservationstockeeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Reservationstockee object
        }


        // Set the correct dbName
        $query = ReservationstockeeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ReservationstockeeTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ReservationstockeeTableMap::buildTableMap();
