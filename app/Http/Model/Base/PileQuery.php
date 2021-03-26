<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Pile as ChildPile;
use App\Http\Model\PileQuery as ChildPileQuery;
use App\Http\Model\Map\PileTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'pile' table.
 *
 *
 *
 * @method     ChildPileQuery orderByNumpile($order = Criteria::ASC) Order by the numPile column
 * @method     ChildPileQuery orderByNumtravee($order = Criteria::ASC) Order by the numTravee column
 * @method     ChildPileQuery orderByCodebloc($order = Criteria::ASC) Order by the codeBloc column
 * @method     ChildPileQuery orderByCapacite($order = Criteria::ASC) Order by the capacite column
 *
 * @method     ChildPileQuery groupByNumpile() Group by the numPile column
 * @method     ChildPileQuery groupByNumtravee() Group by the numTravee column
 * @method     ChildPileQuery groupByCodebloc() Group by the codeBloc column
 * @method     ChildPileQuery groupByCapacite() Group by the capacite column
 *
 * @method     ChildPileQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPileQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPileQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPileQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPileQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPileQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPileQuery leftJoinTravee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Travee relation
 * @method     ChildPileQuery rightJoinTravee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Travee relation
 * @method     ChildPileQuery innerJoinTravee($relationAlias = null) Adds a INNER JOIN clause to the query using the Travee relation
 *
 * @method     ChildPileQuery joinWithTravee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Travee relation
 *
 * @method     ChildPileQuery leftJoinWithTravee() Adds a LEFT JOIN clause and with to the query using the Travee relation
 * @method     ChildPileQuery rightJoinWithTravee() Adds a RIGHT JOIN clause and with to the query using the Travee relation
 * @method     ChildPileQuery innerJoinWithTravee() Adds a INNER JOIN clause and with to the query using the Travee relation
 *
 * @method     ChildPileQuery leftJoinReservationstockee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Reservationstockee relation
 * @method     ChildPileQuery rightJoinReservationstockee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Reservationstockee relation
 * @method     ChildPileQuery innerJoinReservationstockee($relationAlias = null) Adds a INNER JOIN clause to the query using the Reservationstockee relation
 *
 * @method     ChildPileQuery joinWithReservationstockee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Reservationstockee relation
 *
 * @method     ChildPileQuery leftJoinWithReservationstockee() Adds a LEFT JOIN clause and with to the query using the Reservationstockee relation
 * @method     ChildPileQuery rightJoinWithReservationstockee() Adds a RIGHT JOIN clause and with to the query using the Reservationstockee relation
 * @method     ChildPileQuery innerJoinWithReservationstockee() Adds a INNER JOIN clause and with to the query using the Reservationstockee relation
 *
 * @method     \App\Http\Model\TraveeQuery|\App\Http\Model\ReservationstockeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPile|null findOne(ConnectionInterface $con = null) Return the first ChildPile matching the query
 * @method     ChildPile findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPile matching the query, or a new ChildPile object populated from the query conditions when no match is found
 *
 * @method     ChildPile|null findOneByNumpile(string $numPile) Return the first ChildPile filtered by the numPile column
 * @method     ChildPile|null findOneByNumtravee(string $numTravee) Return the first ChildPile filtered by the numTravee column
 * @method     ChildPile|null findOneByCodebloc(string $codeBloc) Return the first ChildPile filtered by the codeBloc column
 * @method     ChildPile|null findOneByCapacite(int $capacite) Return the first ChildPile filtered by the capacite column *

 * @method     ChildPile requirePk($key, ConnectionInterface $con = null) Return the ChildPile by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPile requireOne(ConnectionInterface $con = null) Return the first ChildPile matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPile requireOneByNumpile(string $numPile) Return the first ChildPile filtered by the numPile column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPile requireOneByNumtravee(string $numTravee) Return the first ChildPile filtered by the numTravee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPile requireOneByCodebloc(string $codeBloc) Return the first ChildPile filtered by the codeBloc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPile requireOneByCapacite(int $capacite) Return the first ChildPile filtered by the capacite column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPile[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPile objects based on current ModelCriteria
 * @method     ChildPile[]|ObjectCollection findByNumpile(string $numPile) Return ChildPile objects filtered by the numPile column
 * @method     ChildPile[]|ObjectCollection findByNumtravee(string $numTravee) Return ChildPile objects filtered by the numTravee column
 * @method     ChildPile[]|ObjectCollection findByCodebloc(string $codeBloc) Return ChildPile objects filtered by the codeBloc column
 * @method     ChildPile[]|ObjectCollection findByCapacite(int $capacite) Return ChildPile objects filtered by the capacite column
 * @method     ChildPile[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PileQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Http\Model\Base\PileQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ws-zstockage-connection', $modelName = '\\App\\Http\\Model\\Pile', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPileQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPileQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPileQuery) {
            return $criteria;
        }
        $query = new ChildPileQuery();
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
     * $obj = $c->findPk(array(12, 34, 56), $con);
     * </code>
     *
     * @param array[$numPile, $numTravee, $codeBloc] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPile|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PileTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PileTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2])]))))) {
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
     * @return ChildPile A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT numPile, numTravee, codeBloc, capacite FROM pile WHERE numPile = :p0 AND numTravee = :p1 AND codeBloc = :p2';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPile $obj */
            $obj = new ChildPile();
            $obj->hydrate($row);
            PileTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2])]));
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
     * @return ChildPile|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPileQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PileTableMap::COL_NUMPILE, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PileTableMap::COL_NUMTRAVEE, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(PileTableMap::COL_CODEBLOC, $key[2], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPileQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PileTableMap::COL_NUMPILE, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PileTableMap::COL_NUMTRAVEE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(PileTableMap::COL_CODEBLOC, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the numPile column
     *
     * Example usage:
     * <code>
     * $query->filterByNumpile('fooValue');   // WHERE numPile = 'fooValue'
     * $query->filterByNumpile('%fooValue%', Criteria::LIKE); // WHERE numPile LIKE '%fooValue%'
     * </code>
     *
     * @param     string $numpile The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPileQuery The current query, for fluid interface
     */
    public function filterByNumpile($numpile = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($numpile)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PileTableMap::COL_NUMPILE, $numpile, $comparison);
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
     * @return $this|ChildPileQuery The current query, for fluid interface
     */
    public function filterByNumtravee($numtravee = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($numtravee)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PileTableMap::COL_NUMTRAVEE, $numtravee, $comparison);
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
     * @return $this|ChildPileQuery The current query, for fluid interface
     */
    public function filterByCodebloc($codebloc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codebloc)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PileTableMap::COL_CODEBLOC, $codebloc, $comparison);
    }

    /**
     * Filter the query on the capacite column
     *
     * Example usage:
     * <code>
     * $query->filterByCapacite(1234); // WHERE capacite = 1234
     * $query->filterByCapacite(array(12, 34)); // WHERE capacite IN (12, 34)
     * $query->filterByCapacite(array('min' => 12)); // WHERE capacite > 12
     * </code>
     *
     * @param     mixed $capacite The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPileQuery The current query, for fluid interface
     */
    public function filterByCapacite($capacite = null, $comparison = null)
    {
        if (is_array($capacite)) {
            $useMinMax = false;
            if (isset($capacite['min'])) {
                $this->addUsingAlias(PileTableMap::COL_CAPACITE, $capacite['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($capacite['max'])) {
                $this->addUsingAlias(PileTableMap::COL_CAPACITE, $capacite['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PileTableMap::COL_CAPACITE, $capacite, $comparison);
    }

    /**
     * Filter the query by a related \App\Http\Model\Travee object
     *
     * @param \App\Http\Model\Travee $travee The related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPileQuery The current query, for fluid interface
     */
    public function filterByTravee($travee, $comparison = null)
    {
        if ($travee instanceof \App\Http\Model\Travee) {
            return $this
                ->addUsingAlias(PileTableMap::COL_NUMTRAVEE, $travee->getNumtravee(), $comparison)
                ->addUsingAlias(PileTableMap::COL_CODEBLOC, $travee->getCodebloc(), $comparison);
        } else {
            throw new PropelException('filterByTravee() only accepts arguments of type \App\Http\Model\Travee');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Travee relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPileQuery The current query, for fluid interface
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
     * Filter the query by a related \App\Http\Model\Reservationstockee object
     *
     * @param \App\Http\Model\Reservationstockee|ObjectCollection $reservationstockee the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPileQuery The current query, for fluid interface
     */
    public function filterByReservationstockee($reservationstockee, $comparison = null)
    {
        if ($reservationstockee instanceof \App\Http\Model\Reservationstockee) {
            return $this
                ->addUsingAlias(PileTableMap::COL_NUMPILE, $reservationstockee->getNumpile(), $comparison)
                ->addUsingAlias(PileTableMap::COL_NUMTRAVEE, $reservationstockee->getNumtravee(), $comparison)
                ->addUsingAlias(PileTableMap::COL_CODEBLOC, $reservationstockee->getCodebloc(), $comparison);
        } else {
            throw new PropelException('filterByReservationstockee() only accepts arguments of type \App\Http\Model\Reservationstockee');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Reservationstockee relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPileQuery The current query, for fluid interface
     */
    public function joinReservationstockee($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Reservationstockee');

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
            $this->addJoinObject($join, 'Reservationstockee');
        }

        return $this;
    }

    /**
     * Use the Reservationstockee relation Reservationstockee object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\ReservationstockeeQuery A secondary query class using the current class as primary query
     */
    public function useReservationstockeeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinReservationstockee($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Reservationstockee', '\App\Http\Model\ReservationstockeeQuery');
    }

    /**
     * Use the Reservationstockee relation Reservationstockee object
     *
     * @param callable(\App\Http\Model\ReservationstockeeQuery):\App\Http\Model\ReservationstockeeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withReservationstockeeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useReservationstockeeQuery(
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
     * @param   ChildPile $pile Object to remove from the list of results
     *
     * @return $this|ChildPileQuery The current query, for fluid interface
     */
    public function prune($pile = null)
    {
        if ($pile) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PileTableMap::COL_NUMPILE), $pile->getNumpile(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PileTableMap::COL_NUMTRAVEE), $pile->getNumtravee(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(PileTableMap::COL_CODEBLOC), $pile->getCodebloc(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the pile table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PileTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PileTableMap::clearInstancePool();
            PileTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PileTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PileTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PileTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PileTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PileQuery
