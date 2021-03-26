<?php

namespace App\Http\Model\Map;

use App\Http\Model\Reservation;
use App\Http\Model\ReservationQuery;
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
 * This class defines the structure of the 'reservation' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ReservationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ReservationTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'ws-zstockage-connection';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'reservation';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Http\\Model\\Reservation';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Reservation';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id field
     */
    const COL_ID = 'reservation.id';

    /**
     * the column name for the dateReservation field
     */
    const COL_DATERESERVATION = 'reservation.dateReservation';

    /**
     * the column name for the datePrevueStockage field
     */
    const COL_DATEPREVUESTOCKAGE = 'reservation.datePrevueStockage';

    /**
     * the column name for the nbJoursDeStockagePrevu field
     */
    const COL_NBJOURSDESTOCKAGEPREVU = 'reservation.nbJoursDeStockagePrevu';

    /**
     * the column name for the quantite field
     */
    const COL_QUANTITE = 'reservation.quantite';

    /**
     * the column name for the etat field
     */
    const COL_ETAT = 'reservation.etat';

    /**
     * the column name for the numClient field
     */
    const COL_NUMCLIENT = 'reservation.numClient';

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
        self::TYPE_PHPNAME       => array('Id', 'Datereservation', 'Dateprevuestockage', 'Nbjoursdestockageprevu', 'Quantite', 'Etat', 'Numclient', ),
        self::TYPE_CAMELNAME     => array('id', 'datereservation', 'dateprevuestockage', 'nbjoursdestockageprevu', 'quantite', 'etat', 'numclient', ),
        self::TYPE_COLNAME       => array(ReservationTableMap::COL_ID, ReservationTableMap::COL_DATERESERVATION, ReservationTableMap::COL_DATEPREVUESTOCKAGE, ReservationTableMap::COL_NBJOURSDESTOCKAGEPREVU, ReservationTableMap::COL_QUANTITE, ReservationTableMap::COL_ETAT, ReservationTableMap::COL_NUMCLIENT, ),
        self::TYPE_FIELDNAME     => array('id', 'dateReservation', 'datePrevueStockage', 'nbJoursDeStockagePrevu', 'quantite', 'etat', 'numClient', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Datereservation' => 1, 'Dateprevuestockage' => 2, 'Nbjoursdestockageprevu' => 3, 'Quantite' => 4, 'Etat' => 5, 'Numclient' => 6, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'datereservation' => 1, 'dateprevuestockage' => 2, 'nbjoursdestockageprevu' => 3, 'quantite' => 4, 'etat' => 5, 'numclient' => 6, ),
        self::TYPE_COLNAME       => array(ReservationTableMap::COL_ID => 0, ReservationTableMap::COL_DATERESERVATION => 1, ReservationTableMap::COL_DATEPREVUESTOCKAGE => 2, ReservationTableMap::COL_NBJOURSDESTOCKAGEPREVU => 3, ReservationTableMap::COL_QUANTITE => 4, ReservationTableMap::COL_ETAT => 5, ReservationTableMap::COL_NUMCLIENT => 6, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'dateReservation' => 1, 'datePrevueStockage' => 2, 'nbJoursDeStockagePrevu' => 3, 'quantite' => 4, 'etat' => 5, 'numClient' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'Id' => 'ID',
        'Reservation.Id' => 'ID',
        'id' => 'ID',
        'reservation.id' => 'ID',
        'ReservationTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'id' => 'ID',
        'reservation.id' => 'ID',
        'Datereservation' => 'DATERESERVATION',
        'Reservation.Datereservation' => 'DATERESERVATION',
        'datereservation' => 'DATERESERVATION',
        'reservation.datereservation' => 'DATERESERVATION',
        'ReservationTableMap::COL_DATERESERVATION' => 'DATERESERVATION',
        'COL_DATERESERVATION' => 'DATERESERVATION',
        'dateReservation' => 'DATERESERVATION',
        'reservation.dateReservation' => 'DATERESERVATION',
        'Dateprevuestockage' => 'DATEPREVUESTOCKAGE',
        'Reservation.Dateprevuestockage' => 'DATEPREVUESTOCKAGE',
        'dateprevuestockage' => 'DATEPREVUESTOCKAGE',
        'reservation.dateprevuestockage' => 'DATEPREVUESTOCKAGE',
        'ReservationTableMap::COL_DATEPREVUESTOCKAGE' => 'DATEPREVUESTOCKAGE',
        'COL_DATEPREVUESTOCKAGE' => 'DATEPREVUESTOCKAGE',
        'datePrevueStockage' => 'DATEPREVUESTOCKAGE',
        'reservation.datePrevueStockage' => 'DATEPREVUESTOCKAGE',
        'Nbjoursdestockageprevu' => 'NBJOURSDESTOCKAGEPREVU',
        'Reservation.Nbjoursdestockageprevu' => 'NBJOURSDESTOCKAGEPREVU',
        'nbjoursdestockageprevu' => 'NBJOURSDESTOCKAGEPREVU',
        'reservation.nbjoursdestockageprevu' => 'NBJOURSDESTOCKAGEPREVU',
        'ReservationTableMap::COL_NBJOURSDESTOCKAGEPREVU' => 'NBJOURSDESTOCKAGEPREVU',
        'COL_NBJOURSDESTOCKAGEPREVU' => 'NBJOURSDESTOCKAGEPREVU',
        'nbJoursDeStockagePrevu' => 'NBJOURSDESTOCKAGEPREVU',
        'reservation.nbJoursDeStockagePrevu' => 'NBJOURSDESTOCKAGEPREVU',
        'Quantite' => 'QUANTITE',
        'Reservation.Quantite' => 'QUANTITE',
        'quantite' => 'QUANTITE',
        'reservation.quantite' => 'QUANTITE',
        'ReservationTableMap::COL_QUANTITE' => 'QUANTITE',
        'COL_QUANTITE' => 'QUANTITE',
        'quantite' => 'QUANTITE',
        'reservation.quantite' => 'QUANTITE',
        'Etat' => 'ETAT',
        'Reservation.Etat' => 'ETAT',
        'etat' => 'ETAT',
        'reservation.etat' => 'ETAT',
        'ReservationTableMap::COL_ETAT' => 'ETAT',
        'COL_ETAT' => 'ETAT',
        'etat' => 'ETAT',
        'reservation.etat' => 'ETAT',
        'Numclient' => 'NUMCLIENT',
        'Reservation.Numclient' => 'NUMCLIENT',
        'numclient' => 'NUMCLIENT',
        'reservation.numclient' => 'NUMCLIENT',
        'ReservationTableMap::COL_NUMCLIENT' => 'NUMCLIENT',
        'COL_NUMCLIENT' => 'NUMCLIENT',
        'numClient' => 'NUMCLIENT',
        'reservation.numClient' => 'NUMCLIENT',
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
        $this->setName('reservation');
        $this->setPhpName('Reservation');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Http\\Model\\Reservation');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('dateReservation', 'Datereservation', 'DATE', true, null, null);
        $this->addColumn('datePrevueStockage', 'Dateprevuestockage', 'DATE', true, null, null);
        $this->addColumn('nbJoursDeStockagePrevu', 'Nbjoursdestockageprevu', 'SMALLINT', true, null, null);
        $this->addColumn('quantite', 'Quantite', 'INTEGER', true, null, null);
        $this->addColumn('etat', 'Etat', 'CHAR', true, null, null);
        $this->addForeignKey('numClient', 'Numclient', 'INTEGER', 'utilisateur', 'numUtilisateur', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Utilisateur', '\\App\\Http\\Model\\Utilisateur', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':numClient',
    1 => ':numUtilisateur',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('Reservationstockee', '\\App\\Http\\Model\\Reservationstockee', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':idReservation',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'Reservationstockees', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to reservation     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        ReservationstockeeTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
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
        return $withPrefix ? ReservationTableMap::CLASS_DEFAULT : ReservationTableMap::OM_CLASS;
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
     * @return array           (Reservation object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ReservationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ReservationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ReservationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ReservationTableMap::OM_CLASS;
            /** @var Reservation $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ReservationTableMap::addInstanceToPool($obj, $key);
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
            $key = ReservationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ReservationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Reservation $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ReservationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ReservationTableMap::COL_ID);
            $criteria->addSelectColumn(ReservationTableMap::COL_DATERESERVATION);
            $criteria->addSelectColumn(ReservationTableMap::COL_DATEPREVUESTOCKAGE);
            $criteria->addSelectColumn(ReservationTableMap::COL_NBJOURSDESTOCKAGEPREVU);
            $criteria->addSelectColumn(ReservationTableMap::COL_QUANTITE);
            $criteria->addSelectColumn(ReservationTableMap::COL_ETAT);
            $criteria->addSelectColumn(ReservationTableMap::COL_NUMCLIENT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.dateReservation');
            $criteria->addSelectColumn($alias . '.datePrevueStockage');
            $criteria->addSelectColumn($alias . '.nbJoursDeStockagePrevu');
            $criteria->addSelectColumn($alias . '.quantite');
            $criteria->addSelectColumn($alias . '.etat');
            $criteria->addSelectColumn($alias . '.numClient');
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
            $criteria->removeSelectColumn(ReservationTableMap::COL_ID);
            $criteria->removeSelectColumn(ReservationTableMap::COL_DATERESERVATION);
            $criteria->removeSelectColumn(ReservationTableMap::COL_DATEPREVUESTOCKAGE);
            $criteria->removeSelectColumn(ReservationTableMap::COL_NBJOURSDESTOCKAGEPREVU);
            $criteria->removeSelectColumn(ReservationTableMap::COL_QUANTITE);
            $criteria->removeSelectColumn(ReservationTableMap::COL_ETAT);
            $criteria->removeSelectColumn(ReservationTableMap::COL_NUMCLIENT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.dateReservation');
            $criteria->removeSelectColumn($alias . '.datePrevueStockage');
            $criteria->removeSelectColumn($alias . '.nbJoursDeStockagePrevu');
            $criteria->removeSelectColumn($alias . '.quantite');
            $criteria->removeSelectColumn($alias . '.etat');
            $criteria->removeSelectColumn($alias . '.numClient');
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
        return Propel::getServiceContainer()->getDatabaseMap(ReservationTableMap::DATABASE_NAME)->getTable(ReservationTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ReservationTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ReservationTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ReservationTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Reservation or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Reservation object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ReservationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Http\Model\Reservation) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ReservationTableMap::DATABASE_NAME);
            $criteria->add(ReservationTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ReservationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ReservationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ReservationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the reservation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ReservationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Reservation or Criteria object.
     *
     * @param mixed               $criteria Criteria or Reservation object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReservationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Reservation object
        }

        if ($criteria->containsKey(ReservationTableMap::COL_ID) && $criteria->keyContainsValue(ReservationTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ReservationTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ReservationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ReservationTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ReservationTableMap::buildTableMap();
