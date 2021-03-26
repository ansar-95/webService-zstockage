<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Utilisateur as ChildUtilisateur;
use App\Http\Model\UtilisateurQuery as ChildUtilisateurQuery;
use App\Http\Model\Map\UtilisateurTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'utilisateur' table.
 *
 *
 *
 * @method     ChildUtilisateurQuery orderByNumutilisateur($order = Criteria::ASC) Order by the numUtilisateur column
 * @method     ChildUtilisateurQuery orderByRaisonsociale($order = Criteria::ASC) Order by the raisonSociale column
 * @method     ChildUtilisateurQuery orderByLogin($order = Criteria::ASC) Order by the login column
 * @method     ChildUtilisateurQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildUtilisateurQuery orderByType($order = Criteria::ASC) Order by the type column
 *
 * @method     ChildUtilisateurQuery groupByNumutilisateur() Group by the numUtilisateur column
 * @method     ChildUtilisateurQuery groupByRaisonsociale() Group by the raisonSociale column
 * @method     ChildUtilisateurQuery groupByLogin() Group by the login column
 * @method     ChildUtilisateurQuery groupByPassword() Group by the password column
 * @method     ChildUtilisateurQuery groupByType() Group by the type column
 *
 * @method     ChildUtilisateurQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUtilisateurQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUtilisateurQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUtilisateurQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUtilisateurQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUtilisateurQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUtilisateurQuery leftJoinReservation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Reservation relation
 * @method     ChildUtilisateurQuery rightJoinReservation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Reservation relation
 * @method     ChildUtilisateurQuery innerJoinReservation($relationAlias = null) Adds a INNER JOIN clause to the query using the Reservation relation
 *
 * @method     ChildUtilisateurQuery joinWithReservation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Reservation relation
 *
 * @method     ChildUtilisateurQuery leftJoinWithReservation() Adds a LEFT JOIN clause and with to the query using the Reservation relation
 * @method     ChildUtilisateurQuery rightJoinWithReservation() Adds a RIGHT JOIN clause and with to the query using the Reservation relation
 * @method     ChildUtilisateurQuery innerJoinWithReservation() Adds a INNER JOIN clause and with to the query using the Reservation relation
 *
 * @method     \App\Http\Model\ReservationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUtilisateur|null findOne(ConnectionInterface $con = null) Return the first ChildUtilisateur matching the query
 * @method     ChildUtilisateur findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUtilisateur matching the query, or a new ChildUtilisateur object populated from the query conditions when no match is found
 *
 * @method     ChildUtilisateur|null findOneByNumutilisateur(int $numUtilisateur) Return the first ChildUtilisateur filtered by the numUtilisateur column
 * @method     ChildUtilisateur|null findOneByRaisonsociale(string $raisonSociale) Return the first ChildUtilisateur filtered by the raisonSociale column
 * @method     ChildUtilisateur|null findOneByLogin(string $login) Return the first ChildUtilisateur filtered by the login column
 * @method     ChildUtilisateur|null findOneByPassword(string $password) Return the first ChildUtilisateur filtered by the password column
 * @method     ChildUtilisateur|null findOneByType(string $type) Return the first ChildUtilisateur filtered by the type column *

 * @method     ChildUtilisateur requirePk($key, ConnectionInterface $con = null) Return the ChildUtilisateur by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOne(ConnectionInterface $con = null) Return the first ChildUtilisateur matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUtilisateur requireOneByNumutilisateur(int $numUtilisateur) Return the first ChildUtilisateur filtered by the numUtilisateur column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByRaisonsociale(string $raisonSociale) Return the first ChildUtilisateur filtered by the raisonSociale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByLogin(string $login) Return the first ChildUtilisateur filtered by the login column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByPassword(string $password) Return the first ChildUtilisateur filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByType(string $type) Return the first ChildUtilisateur filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUtilisateur[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUtilisateur objects based on current ModelCriteria
 * @method     ChildUtilisateur[]|ObjectCollection findByNumutilisateur(int $numUtilisateur) Return ChildUtilisateur objects filtered by the numUtilisateur column
 * @method     ChildUtilisateur[]|ObjectCollection findByRaisonsociale(string $raisonSociale) Return ChildUtilisateur objects filtered by the raisonSociale column
 * @method     ChildUtilisateur[]|ObjectCollection findByLogin(string $login) Return ChildUtilisateur objects filtered by the login column
 * @method     ChildUtilisateur[]|ObjectCollection findByPassword(string $password) Return ChildUtilisateur objects filtered by the password column
 * @method     ChildUtilisateur[]|ObjectCollection findByType(string $type) Return ChildUtilisateur objects filtered by the type column
 * @method     ChildUtilisateur[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UtilisateurQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Http\Model\Base\UtilisateurQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ws-zstockage-connection', $modelName = '\\App\\Http\\Model\\Utilisateur', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUtilisateurQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUtilisateurQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUtilisateurQuery) {
            return $criteria;
        }
        $query = new ChildUtilisateurQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUtilisateur|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UtilisateurTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UtilisateurTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUtilisateur A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT numUtilisateur, raisonSociale, login, password, type FROM utilisateur WHERE numUtilisateur = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUtilisateur $obj */
            $obj = new ChildUtilisateur();
            $obj->hydrate($row);
            UtilisateurTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildUtilisateur|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UtilisateurTableMap::COL_NUMUTILISATEUR, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UtilisateurTableMap::COL_NUMUTILISATEUR, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the numUtilisateur column
     *
     * Example usage:
     * <code>
     * $query->filterByNumutilisateur(1234); // WHERE numUtilisateur = 1234
     * $query->filterByNumutilisateur(array(12, 34)); // WHERE numUtilisateur IN (12, 34)
     * $query->filterByNumutilisateur(array('min' => 12)); // WHERE numUtilisateur > 12
     * </code>
     *
     * @param     mixed $numutilisateur The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
     */
    public function filterByNumutilisateur($numutilisateur = null, $comparison = null)
    {
        if (is_array($numutilisateur)) {
            $useMinMax = false;
            if (isset($numutilisateur['min'])) {
                $this->addUsingAlias(UtilisateurTableMap::COL_NUMUTILISATEUR, $numutilisateur['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($numutilisateur['max'])) {
                $this->addUsingAlias(UtilisateurTableMap::COL_NUMUTILISATEUR, $numutilisateur['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UtilisateurTableMap::COL_NUMUTILISATEUR, $numutilisateur, $comparison);
    }

    /**
     * Filter the query on the raisonSociale column
     *
     * Example usage:
     * <code>
     * $query->filterByRaisonsociale('fooValue');   // WHERE raisonSociale = 'fooValue'
     * $query->filterByRaisonsociale('%fooValue%', Criteria::LIKE); // WHERE raisonSociale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $raisonsociale The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
     */
    public function filterByRaisonsociale($raisonsociale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($raisonsociale)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UtilisateurTableMap::COL_RAISONSOCIALE, $raisonsociale, $comparison);
    }

    /**
     * Filter the query on the login column
     *
     * Example usage:
     * <code>
     * $query->filterByLogin('fooValue');   // WHERE login = 'fooValue'
     * $query->filterByLogin('%fooValue%', Criteria::LIKE); // WHERE login LIKE '%fooValue%'
     * </code>
     *
     * @param     string $login The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
     */
    public function filterByLogin($login = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($login)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UtilisateurTableMap::COL_LOGIN, $login, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UtilisateurTableMap::COL_PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UtilisateurTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query by a related \App\Http\Model\Reservation object
     *
     * @param \App\Http\Model\Reservation|ObjectCollection $reservation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUtilisateurQuery The current query, for fluid interface
     */
    public function filterByReservation($reservation, $comparison = null)
    {
        if ($reservation instanceof \App\Http\Model\Reservation) {
            return $this
                ->addUsingAlias(UtilisateurTableMap::COL_NUMUTILISATEUR, $reservation->getNumclient(), $comparison);
        } elseif ($reservation instanceof ObjectCollection) {
            return $this
                ->useReservationQuery()
                ->filterByPrimaryKeys($reservation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByReservation() only accepts arguments of type \App\Http\Model\Reservation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Reservation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
     */
    public function joinReservation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Reservation');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Reservation');
        }

        return $this;
    }

    /**
     * Use the Reservation relation Reservation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\ReservationQuery A secondary query class using the current class as primary query
     */
    public function useReservationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinReservation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Reservation', '\App\Http\Model\ReservationQuery');
    }

    /**
     * Use the Reservation relation Reservation object
     *
     * @param callable(\App\Http\Model\ReservationQuery):\App\Http\Model\ReservationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withReservationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useReservationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUtilisateur $utilisateur Object to remove from the list of results
     *
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
     */
    public function prune($utilisateur = null)
    {
        if ($utilisateur) {
            $this->addUsingAlias(UtilisateurTableMap::COL_NUMUTILISATEUR, $utilisateur->getNumutilisateur(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the utilisateur table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UtilisateurTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UtilisateurTableMap::clearInstancePool();
            UtilisateurTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UtilisateurTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UtilisateurTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UtilisateurTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UtilisateurTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UtilisateurQuery
