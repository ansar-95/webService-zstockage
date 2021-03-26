<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Bloc as ChildBloc;
use App\Http\Model\BlocQuery as ChildBlocQuery;
use App\Http\Model\Map\BlocTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'bloc' table.
 *
 *
 *
 * @method     ChildBlocQuery orderByCodebloc($order = Criteria::ASC) Order by the codeBloc column
 *
 * @method     ChildBlocQuery groupByCodebloc() Group by the codeBloc column
 *
 * @method     ChildBlocQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBlocQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBlocQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBlocQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBlocQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBlocQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBlocQuery leftJoinTravee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Travee relation
 * @method     ChildBlocQuery rightJoinTravee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Travee relation
 * @method     ChildBlocQuery innerJoinTravee($relationAlias = null) Adds a INNER JOIN clause to the query using the Travee relation
 *
 * @method     ChildBlocQuery joinWithTravee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Travee relation
 *
 * @method     ChildBlocQuery leftJoinWithTravee() Adds a LEFT JOIN clause and with to the query using the Travee relation
 * @method     ChildBlocQuery rightJoinWithTravee() Adds a RIGHT JOIN clause and with to the query using the Travee relation
 * @method     ChildBlocQuery innerJoinWithTravee() Adds a INNER JOIN clause and with to the query using the Travee relation
 *
 * @method     \App\Http\Model\TraveeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBloc|null findOne(ConnectionInterface $con = null) Return the first ChildBloc matching the query
 * @method     ChildBloc findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBloc matching the query, or a new ChildBloc object populated from the query conditions when no match is found
 *
 * @method     ChildBloc|null findOneByCodebloc(string $codeBloc) Return the first ChildBloc filtered by the codeBloc column *

 * @method     ChildBloc requirePk($key, ConnectionInterface $con = null) Return the ChildBloc by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBloc requireOne(ConnectionInterface $con = null) Return the first ChildBloc matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBloc requireOneByCodebloc(string $codeBloc) Return the first ChildBloc filtered by the codeBloc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBloc[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBloc objects based on current ModelCriteria
 * @method     ChildBloc[]|ObjectCollection findByCodebloc(string $codeBloc) Return ChildBloc objects filtered by the codeBloc column
 * @method     ChildBloc[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BlocQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Http\Model\Base\BlocQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ws-zstockage-connection', $modelName = '\\App\\Http\\Model\\Bloc', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBlocQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBlocQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBlocQuery) {
            return $criteria;
        }
        $query = new ChildBlocQuery();
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
     * @return ChildBloc|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BlocTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BlocTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBloc A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT codeBloc FROM bloc WHERE codeBloc = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildBloc $obj */
            $obj = new ChildBloc();
            $obj->hydrate($row);
            BlocTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBloc|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBlocQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BlocTableMap::COL_CODEBLOC, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBlocQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BlocTableMap::COL_CODEBLOC, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the codeBloc column
     *
     * Example usage:
     * <code>
     * $query->filterByCodebloc('fooValue');   // WHERE codeBloc = 'fooValue'
     * $query->filterByCodebloc('%fooValue%', Criteria::LIKE); // WHERE codeBloc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $codebloc The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBlocQuery The current query, for fluid interface
     */
    public function filterByCodebloc($codebloc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codebloc)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BlocTableMap::COL_CODEBLOC, $codebloc, $comparison);
    }

    /**
     * Filter the query by a related \App\Http\Model\Travee object
     *
     * @param \App\Http\Model\Travee|ObjectCollection $travee the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBlocQuery The current query, for fluid interface
     */
    public function filterByTravee($travee, $comparison = null)
    {
        if ($travee instanceof \App\Http\Model\Travee) {
            return $this
                ->addUsingAlias(BlocTableMap::COL_CODEBLOC, $travee->getCodebloc(), $comparison);
        } elseif ($travee instanceof ObjectCollection) {
            return $this
                ->useTraveeQuery()
                ->filterByPrimaryKeys($travee->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTravee() only accepts arguments of type \App\Http\Model\Travee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Travee relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBlocQuery The current query, for fluid interface
     */
    public function joinTravee($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Travee');

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
            $this->addJoinObject($join, 'Travee');
        }

        return $this;
    }

    /**
     * Use the Travee relation Travee object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\TraveeQuery A secondary query class using the current class as primary query
     */
    public function useTraveeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTravee($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Travee', '\App\Http\Model\TraveeQuery');
    }

    /**
     * Use the Travee relation Travee object
     *
     * @param callable(\App\Http\Model\TraveeQuery):\App\Http\Model\TraveeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTraveeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTraveeQuery(
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
     * @param   ChildBloc $bloc Object to remove from the list of results
     *
     * @return $this|ChildBlocQuery The current query, for fluid interface
     */
    public function prune($bloc = null)
    {
        if ($bloc) {
            $this->addUsingAlias(BlocTableMap::COL_CODEBLOC, $bloc->getCodebloc(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the bloc table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BlocTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BlocTableMap::clearInstancePool();
            BlocTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BlocTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BlocTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BlocTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BlocTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BlocQuery
