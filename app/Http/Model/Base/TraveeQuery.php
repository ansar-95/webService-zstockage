<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Travee as ChildTravee;
use App\Http\Model\TraveeQuery as ChildTraveeQuery;
use App\Http\Model\Map\TraveeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'travee' table.
 *
 *
 *
 * @method     ChildTraveeQuery orderByNumtravee($order = Criteria::ASC) Order by the numTravee column
 * @method     ChildTraveeQuery orderByCodebloc($order = Criteria::ASC) Order by the codeBloc column
 *
 * @method     ChildTraveeQuery groupByNumtravee() Group by the numTravee column
 * @method     ChildTraveeQuery groupByCodebloc() Group by the codeBloc column
 *
 * @method     ChildTraveeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTraveeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTraveeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTraveeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTraveeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTraveeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTraveeQuery leftJoinBloc($relationAlias = null) Adds a LEFT JOIN clause to the query using the Bloc relation
 * @method     ChildTraveeQuery rightJoinBloc($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Bloc relation
 * @method     ChildTraveeQuery innerJoinBloc($relationAlias = null) Adds a INNER JOIN clause to the query using the Bloc relation
 *
 * @method     ChildTraveeQuery joinWithBloc($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Bloc relation
 *
 * @method     ChildTraveeQuery leftJoinWithBloc() Adds a LEFT JOIN clause and with to the query using the Bloc relation
 * @method     ChildTraveeQuery rightJoinWithBloc() Adds a RIGHT JOIN clause and with to the query using the Bloc relation
 * @method     ChildTraveeQuery innerJoinWithBloc() Adds a INNER JOIN clause and with to the query using the Bloc relation
 *
 * @method     ChildTraveeQuery leftJoinPile($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pile relation
 * @method     ChildTraveeQuery rightJoinPile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pile relation
 * @method     ChildTraveeQuery innerJoinPile($relationAlias = null) Adds a INNER JOIN clause to the query using the Pile relation
 *
 * @method     ChildTraveeQuery joinWithPile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pile relation
 *
 * @method     ChildTraveeQuery leftJoinWithPile() Adds a LEFT JOIN clause and with to the query using the Pile relation
 * @method     ChildTraveeQuery rightJoinWithPile() Adds a RIGHT JOIN clause and with to the query using the Pile relation
 * @method     ChildTraveeQuery innerJoinWithPile() Adds a INNER JOIN clause and with to the query using the Pile relation
 *
 * @method     \App\Http\Model\BlocQuery|\App\Http\Model\PileQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTravee|null findOne(ConnectionInterface $con = null) Return the first ChildTravee matching the query
 * @method     ChildTravee findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTravee matching the query, or a new ChildTravee object populated from the query conditions when no match is found
 *
 * @method     ChildTravee|null findOneByNumtravee(string $numTravee) Return the first ChildTravee filtered by the numTravee column
 * @method     ChildTravee|null findOneByCodebloc(string $codeBloc) Return the first ChildTravee filtered by the codeBloc column *

 * @method     ChildTravee requirePk($key, ConnectionInterface $con = null) Return the ChildTravee by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTravee requireOne(ConnectionInterface $con = null) Return the first ChildTravee matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTravee requireOneByNumtravee(string $numTravee) Return the first ChildTravee filtered by the numTravee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTravee requireOneByCodebloc(string $codeBloc) Return the first ChildTravee filtered by the codeBloc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTravee[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTravee objects based on current ModelCriteria
 * @method     ChildTravee[]|ObjectCollection findByNumtravee(string $numTravee) Return ChildTravee objects filtered by the numTravee column
 * @method     ChildTravee[]|ObjectCollection findByCodebloc(string $codeBloc) Return ChildTravee objects filtered by the codeBloc column
 * @method     ChildTravee[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TraveeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Http\Model\Base\TraveeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ws-zstockage-connection', $modelName = '\\App\\Http\\Model\\Travee', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTraveeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTraveeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTraveeQuery) {
            return $criteria;
        }
        $query = new ChildTraveeQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$numTravee, $codeBloc] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildTravee|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TraveeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TraveeTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildTravee A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT numTravee, codeBloc FROM travee WHERE numTravee = :p0 AND codeBloc = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildTravee $obj */
            $obj = new ChildTravee();
            $obj->hydrate($row);
            TraveeTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildTravee|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildTraveeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(TraveeTableMap::COL_NUMTRAVEE, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(TraveeTableMap::COL_CODEBLOC, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTraveeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(TraveeTableMap::COL_NUMTRAVEE, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(TraveeTableMap::COL_CODEBLOC, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the numTravee column
     *
     * Example usage:
     * <code>
     * $query->filterByNumtravee('fooValue');   // WHERE numTravee = 'fooValue'
     * $query->filterByNumtravee('%fooValue%', Criteria::LIKE); // WHERE numTravee LIKE '%fooValue%'
     * </code>
     *
     * @param     string $numtravee The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTraveeQuery The current query, for fluid interface
     */
    public function filterByNumtravee($numtravee = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($numtravee)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TraveeTableMap::COL_NUMTRAVEE, $numtravee, $comparison);
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
     * @return $this|ChildTraveeQuery The current query, for fluid interface
     */
    public function filterByCodebloc($codebloc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codebloc)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TraveeTableMap::COL_CODEBLOC, $codebloc, $comparison);
    }

    /**
     * Filter the query by a related \App\Http\Model\Bloc object
     *
     * @param \App\Http\Model\Bloc|ObjectCollection $bloc The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTraveeQuery The current query, for fluid interface
     */
    public function filterByBloc($bloc, $comparison = null)
    {
        if ($bloc instanceof \App\Http\Model\Bloc) {
            return $this
                ->addUsingAlias(TraveeTableMap::COL_CODEBLOC, $bloc->getCodebloc(), $comparison);
        } elseif ($bloc instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TraveeTableMap::COL_CODEBLOC, $bloc->toKeyValue('PrimaryKey', 'Codebloc'), $comparison);
        } else {
            throw new PropelException('filterByBloc() only accepts arguments of type \App\Http\Model\Bloc or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Bloc relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTraveeQuery The current query, for fluid interface
     */
    public function joinBloc($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Bloc');

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
            $this->addJoinObject($join, 'Bloc');
        }

        return $this;
    }

    /**
     * Use the Bloc relation Bloc object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\BlocQuery A secondary query class using the current class as primary query
     */
    public function useBlocQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBloc($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Bloc', '\App\Http\Model\BlocQuery');
    }

    /**
     * Use the Bloc relation Bloc object
     *
     * @param callable(\App\Http\Model\BlocQuery):\App\Http\Model\BlocQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBlocQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useBlocQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Filter the query by a related \App\Http\Model\Pile object
     *
     * @param \App\Http\Model\Pile|ObjectCollection $pile the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTraveeQuery The current query, for fluid interface
     */
    public function filterByPile($pile, $comparison = null)
    {
        if ($pile instanceof \App\Http\Model\Pile) {
            return $this
                ->addUsingAlias(TraveeTableMap::COL_NUMTRAVEE, $pile->getNumtravee(), $comparison)
                ->addUsingAlias(TraveeTableMap::COL_CODEBLOC, $pile->getCodebloc(), $comparison);
        } else {
            throw new PropelException('filterByPile() only accepts arguments of type \App\Http\Model\Pile');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Pile relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTraveeQuery The current query, for fluid interface
     */
    public function joinPile($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Pile');

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
            $this->addJoinObject($join, 'Pile');
        }

        return $this;
    }

    /**
     * Use the Pile relation Pile object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\PileQuery A secondary query class using the current class as primary query
     */
    public function usePileQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPile($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Pile', '\App\Http\Model\PileQuery');
    }

    /**
     * Use the Pile relation Pile object
     *
     * @param callable(\App\Http\Model\PileQuery):\App\Http\Model\PileQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPileQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePileQuery(
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
     * @param   ChildTravee $travee Object to remove from the list of results
     *
     * @return $this|ChildTraveeQuery The current query, for fluid interface
     */
    public function prune($travee = null)
    {
        if ($travee) {
            $this->addCond('pruneCond0', $this->getAliasedColName(TraveeTableMap::COL_NUMTRAVEE), $travee->getNumtravee(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(TraveeTableMap::COL_CODEBLOC), $travee->getCodebloc(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the travee table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TraveeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TraveeTableMap::clearInstancePool();
            TraveeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TraveeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TraveeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TraveeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TraveeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TraveeQuery
