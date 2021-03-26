<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Reservationstockee as ChildReservationstockee;
use App\Http\Model\ReservationstockeeQuery as ChildReservationstockeeQuery;
use App\Http\Model\Map\ReservationstockeeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'reservationStockee' table.
 *
 *
 *
 * @method     ChildReservationstockeeQuery orderByNumpile($order = Criteria::ASC) Order by the numPile column
 * @method     ChildReservationstockeeQuery orderByNumtravee($order = Criteria::ASC) Order by the numTravee column
 * @method     ChildReservationstockeeQuery orderByCodebloc($order = Criteria::ASC) Order by the codeBloc column
 * @method     ChildReservationstockeeQuery orderByIdreservation($order = Criteria::ASC) Order by the idReservation column
 * @method     ChildReservationstockeeQuery orderByEmplacementdepart($order = Criteria::ASC) Order by the emplacementDepart column
 * @method     ChildReservationstockeeQuery orderByQuantite($order = Criteria::ASC) Order by the quantite column
 * @method     ChildReservationstockeeQuery orderByDatedebuteffective($order = Criteria::ASC) Order by the dateDebutEffective column
 * @method     ChildReservationstockeeQuery orderByDatefineffective($order = Criteria::ASC) Order by the dateFinEffective column
 *
 * @method     ChildReservationstockeeQuery groupByNumpile() Group by the numPile column
 * @method     ChildReservationstockeeQuery groupByNumtravee() Group by the numTravee column
 * @method     ChildReservationstockeeQuery groupByCodebloc() Group by the codeBloc column
 * @method     ChildReservationstockeeQuery groupByIdreservation() Group by the idReservation column
 * @method     ChildReservationstockeeQuery groupByEmplacementdepart() Group by the emplacementDepart column
 * @method     ChildReservationstockeeQuery groupByQuantite() Group by the quantite column
 * @method     ChildReservationstockeeQuery groupByDatedebuteffective() Group by the dateDebutEffective column
 * @method     ChildReservationstockeeQuery groupByDatefineffective() Group by the dateFinEffective column
 *
 * @method     ChildReservationstockeeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildReservationstockeeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildReservationstockeeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildReservationstockeeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildReservationstockeeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildReservationstockeeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildReservationstockeeQuery leftJoinReservation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Reservation relation
 * @method     ChildReservationstockeeQuery rightJoinReservation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Reservation relation
 * @method     ChildReservationstockeeQuery innerJoinReservation($relationAlias = null) Adds a INNER JOIN clause to the query using the Reservation relation
 *
 * @method     ChildReservationstockeeQuery joinWithReservation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Reservation relation
 *
 * @method     ChildReservationstockeeQuery leftJoinWithReservation() Adds a LEFT JOIN clause and with to the query using the Reservation relation
 * @method     ChildReservationstockeeQuery rightJoinWithReservation() Adds a RIGHT JOIN clause and with to the query using the Reservation relation
 * @method     ChildReservationstockeeQuery innerJoinWithReservation() Adds a INNER JOIN clause and with to the query using the Reservation relation
 *
 * @method     ChildReservationstockeeQuery leftJoinPile($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pile relation
 * @method     ChildReservationstockeeQuery rightJoinPile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pile relation
 * @method     ChildReservationstockeeQuery innerJoinPile($relationAlias = null) Adds a INNER JOIN clause to the query using the Pile relation
 *
 * @method     ChildReservationstockeeQuery joinWithPile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pile relation
 *
 * @method     ChildReservationstockeeQuery leftJoinWithPile() Adds a LEFT JOIN clause and with to the query using the Pile relation
 * @method     ChildReservationstockeeQuery rightJoinWithPile() Adds a RIGHT JOIN clause and with to the query using the Pile relation
 * @method     ChildReservationstockeeQuery innerJoinWithPile() Adds a INNER JOIN clause and with to the query using the Pile relation
 *
 * @method     \App\Http\Model\ReservationQuery|\App\Http\Model\PileQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildReservationstockee|null findOne(ConnectionInterface $con = null) Return the first ChildReservationstockee matching the query
 * @method     ChildReservationstockee findOneOrCreate(ConnectionInterface $con = null) Return the first ChildReservationstockee matching the query, or a new ChildReservationstockee object populated from the query conditions when no match is found
 *
 * @method     ChildReservationstockee|null findOneByNumpile(string $numPile) Return the first ChildReservationstockee filtered by the numPile column
 * @method     ChildReservationstockee|null findOneByNumtravee(string $numTravee) Return the first ChildReservationstockee filtered by the numTravee column
 * @method     ChildReservationstockee|null findOneByCodebloc(string $codeBloc) Return the first ChildReservationstockee filtered by the codeBloc column
 * @method     ChildReservationstockee|null findOneByIdreservation(int $idReservation) Return the first ChildReservationstockee filtered by the idReservation column
 * @method     ChildReservationstockee|null findOneByEmplacementdepart(int $emplacementDepart) Return the first ChildReservationstockee filtered by the emplacementDepart column
 * @method     ChildReservationstockee|null findOneByQuantite(int $quantite) Return the first ChildReservationstockee filtered by the quantite column
 * @method     ChildReservationstockee|null findOneByDatedebuteffective(string $dateDebutEffective) Return the first ChildReservationstockee filtered by the dateDebutEffective column
 * @method     ChildReservationstockee|null findOneByDatefineffective(string $dateFinEffective) Return the first ChildReservationstockee filtered by the dateFinEffective column *

 * @method     ChildReservationstockee requirePk($key, ConnectionInterface $con = null) Return the ChildReservationstockee by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservationstockee requireOne(ConnectionInterface $con = null) Return the first ChildReservationstockee matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReservationstockee requireOneByNumpile(string $numPile) Return the first ChildReservationstockee filtered by the numPile column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservationstockee requireOneByNumtravee(string $numTravee) Return the first ChildReservationstockee filtered by the numTravee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservationstockee requireOneByCodebloc(string $codeBloc) Return the first ChildReservationstockee filtered by the codeBloc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservationstockee requireOneByIdreservation(int $idReservation) Return the first ChildReservationstockee filtered by the idReservation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservationstockee requireOneByEmplacementdepart(int $emplacementDepart) Return the first ChildReservationstockee filtered by the emplacementDepart column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservationstockee requireOneByQuantite(int $quantite) Return the first ChildReservationstockee filtered by the quantite column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservationstockee requireOneByDatedebuteffective(string $dateDebutEffective) Return the first ChildReservationstockee filtered by the dateDebutEffective column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservationstockee requireOneByDatefineffective(string $dateFinEffective) Return the first ChildReservationstockee filtered by the dateFinEffective column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReservationstockee[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildReservationstockee objects based on current ModelCriteria
 * @method     ChildReservationstockee[]|ObjectCollection findByNumpile(string $numPile) Return ChildReservationstockee objects filtered by the numPile column
 * @method     ChildReservationstockee[]|ObjectCollection findByNumtravee(string $numTravee) Return ChildReservationstockee objects filtered by the numTravee column
 * @method     ChildReservationstockee[]|ObjectCollection findByCodebloc(string $codeBloc) Return ChildReservationstockee objects filtered by the codeBloc column
 * @method     ChildReservationstockee[]|ObjectCollection findByIdreservation(int $idReservation) Return ChildReservationstockee objects filtered by the idReservation column
 * @method     ChildReservationstockee[]|ObjectCollection findByEmplacementdepart(int $emplacementDepart) Return ChildReservationstockee objects filtered by the emplacementDepart column
 * @method     ChildReservationstockee[]|ObjectCollection findByQuantite(int $quantite) Return ChildReservationstockee objects filtered by the quantite column
 * @method     ChildReservationstockee[]|ObjectCollection findByDatedebuteffective(string $dateDebutEffective) Return ChildReservationstockee objects filtered by the dateDebutEffective column
 * @method     ChildReservationstockee[]|ObjectCollection findByDatefineffective(string $dateFinEffective) Return ChildReservationstockee objects filtered by the dateFinEffective column
 * @method     ChildReservationstockee[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ReservationstockeeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Http\Model\Base\ReservationstockeeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ws-zstockage-connection', $modelName = '\\App\\Http\\Model\\Reservationstockee', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildReservationstockeeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildReservationstockeeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildReservationstockeeQuery) {
            return $criteria;
        }
        $query = new ChildReservationstockeeQuery();
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
     * $obj = $c->findPk(array(12, 34, 56, 78), $con);
     * </code>
     *
     * @param array[$numPile, $numTravee, $codeBloc, $idReservation] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildReservationstockee|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ReservationstockeeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ReservationstockeeTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2]), (null === $key[3] || is_scalar($key[3]) || is_callable([$key[3], '__toString']) ? (string) $key[3] : $key[3])]))))) {
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
     * @return ChildReservationstockee A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT numPile, numTravee, codeBloc, idReservation, emplacementDepart, quantite, dateDebutEffective, dateFinEffective FROM reservationStockee WHERE numPile = :p0 AND numTravee = :p1 AND codeBloc = :p2 AND idReservation = :p3';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_STR);
            $stmt->bindValue(':p3', $key[3], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildReservationstockee $obj */
            $obj = new ChildReservationstockee();
            $obj->hydrate($row);
            ReservationstockeeTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2]), (null === $key[3] || is_scalar($key[3]) || is_callable([$key[3], '__toString']) ? (string) $key[3] : $key[3])]));
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
     * @return ChildReservationstockee|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildReservationstockeeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ReservationstockeeTableMap::COL_NUMPILE, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ReservationstockeeTableMap::COL_NUMTRAVEE, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(ReservationstockeeTableMap::COL_CODEBLOC, $key[2], Criteria::EQUAL);
        $this->addUsingAlias(ReservationstockeeTableMap::COL_IDRESERVATION, $key[3], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildReservationstockeeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ReservationstockeeTableMap::COL_NUMPILE, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ReservationstockeeTableMap::COL_NUMTRAVEE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(ReservationstockeeTableMap::COL_CODEBLOC, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $cton3 = $this->getNewCriterion(ReservationstockeeTableMap::COL_IDRESERVATION, $key[3], Criteria::EQUAL);
            $cton0->addAnd($cton3);
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
     * @return $this|ChildReservationstockeeQuery The current query, for fluid interface
     */
    public function filterByNumpile($numpile = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($numpile)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReservationstockeeTableMap::COL_NUMPILE, $numpile, $comparison);
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
     * @return $this|ChildReservationstockeeQuery The current query, for fluid interface
     */
    public function filterByNumtravee($numtravee = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($numtravee)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReservationstockeeTableMap::COL_NUMTRAVEE, $numtravee, $comparison);
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
     * @return $this|ChildReservationstockeeQuery The current query, for fluid interface
     */
    public function filterByCodebloc($codebloc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codebloc)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReservationstockeeTableMap::COL_CODEBLOC, $codebloc, $comparison);
    }

    /**
     * Filter the query on the idReservation column
     *
     * Example usage:
     * <code>
     * $query->filterByIdreservation(1234); // WHERE idReservation = 1234
     * $query->filterByIdreservation(array(12, 34)); // WHERE idReservation IN (12, 34)
     * $query->filterByIdreservation(array('min' => 12)); // WHERE idReservation > 12
     * </code>
     *
     * @see       filterByReservation()
     *
     * @param     mixed $idreservation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReservationstockeeQuery The current query, for fluid interface
     */
    public function filterByIdreservation($idreservation = null, $comparison = null)
    {
        if (is_array($idreservation)) {
            $useMinMax = false;
            if (isset($idreservation['min'])) {
                $this->addUsingAlias(ReservationstockeeTableMap::COL_IDRESERVATION, $idreservation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idreservation['max'])) {
                $this->addUsingAlias(ReservationstockeeTableMap::COL_IDRESERVATION, $idreservation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReservationstockeeTableMap::COL_IDRESERVATION, $idreservation, $comparison);
    }

    /**
     * Filter the query on the emplacementDepart column
     *
     * Example usage:
     * <code>
     * $query->filterByEmplacementdepart(1234); // WHERE emplacementDepart = 1234
     * $query->filterByEmplacementdepart(array(12, 34)); // WHERE emplacementDepart IN (12, 34)
     * $query->filterByEmplacementdepart(array('min' => 12)); // WHERE emplacementDepart > 12
     * </code>
     *
     * @param     mixed $emplacementdepart The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReservationstockeeQuery The current query, for fluid interface
     */
    public function filterByEmplacementdepart($emplacementdepart = null, $comparison = null)
    {
        if (is_array($emplacementdepart)) {
            $useMinMax = false;
            if (isset($emplacementdepart['min'])) {
                $this->addUsingAlias(ReservationstockeeTableMap::COL_EMPLACEMENTDEPART, $emplacementdepart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($emplacementdepart['max'])) {
                $this->addUsingAlias(ReservationstockeeTableMap::COL_EMPLACEMENTDEPART, $emplacementdepart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReservationstockeeTableMap::COL_EMPLACEMENTDEPART, $emplacementdepart, $comparison);
    }

    /**
     * Filter the query on the quantite column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantite(1234); // WHERE quantite = 1234
     * $query->filterByQuantite(array(12, 34)); // WHERE quantite IN (12, 34)
     * $query->filterByQuantite(array('min' => 12)); // WHERE quantite > 12
     * </code>
     *
     * @param     mixed $quantite The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReservationstockeeQuery The current query, for fluid interface
     */
    public function filterByQuantite($quantite = null, $comparison = null)
    {
        if (is_array($quantite)) {
            $useMinMax = false;
            if (isset($quantite['min'])) {
                $this->addUsingAlias(ReservationstockeeTableMap::COL_QUANTITE, $quantite['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantite['max'])) {
                $this->addUsingAlias(ReservationstockeeTableMap::COL_QUANTITE, $quantite['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReservationstockeeTableMap::COL_QUANTITE, $quantite, $comparison);
    }

    /**
     * Filter the query on the dateDebutEffective column
     *
     * Example usage:
     * <code>
     * $query->filterByDatedebuteffective('2011-03-14'); // WHERE dateDebutEffective = '2011-03-14'
     * $query->filterByDatedebuteffective('now'); // WHERE dateDebutEffective = '2011-03-14'
     * $query->filterByDatedebuteffective(array('max' => 'yesterday')); // WHERE dateDebutEffective > '2011-03-13'
     * </code>
     *
     * @param     mixed $datedebuteffective The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReservationstockeeQuery The current query, for fluid interface
     */
    public function filterByDatedebuteffective($datedebuteffective = null, $comparison = null)
    {
        if (is_array($datedebuteffective)) {
            $useMinMax = false;
            if (isset($datedebuteffective['min'])) {
                $this->addUsingAlias(ReservationstockeeTableMap::COL_DATEDEBUTEFFECTIVE, $datedebuteffective['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datedebuteffective['max'])) {
                $this->addUsingAlias(ReservationstockeeTableMap::COL_DATEDEBUTEFFECTIVE, $datedebuteffective['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReservationstockeeTableMap::COL_DATEDEBUTEFFECTIVE, $datedebuteffective, $comparison);
    }

    /**
     * Filter the query on the dateFinEffective column
     *
     * Example usage:
     * <code>
     * $query->filterByDatefineffective('2011-03-14'); // WHERE dateFinEffective = '2011-03-14'
     * $query->filterByDatefineffective('now'); // WHERE dateFinEffective = '2011-03-14'
     * $query->filterByDatefineffective(array('max' => 'yesterday')); // WHERE dateFinEffective > '2011-03-13'
     * </code>
     *
     * @param     mixed $datefineffective The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReservationstockeeQuery The current query, for fluid interface
     */
    public function filterByDatefineffective($datefineffective = null, $comparison = null)
    {
        if (is_array($datefineffective)) {
            $useMinMax = false;
            if (isset($datefineffective['min'])) {
                $this->addUsingAlias(ReservationstockeeTableMap::COL_DATEFINEFFECTIVE, $datefineffective['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datefineffective['max'])) {
                $this->addUsingAlias(ReservationstockeeTableMap::COL_DATEFINEFFECTIVE, $datefineffective['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReservationstockeeTableMap::COL_DATEFINEFFECTIVE, $datefineffective, $comparison);
    }

    /**
     * Filter the query by a related \App\Http\Model\Reservation object
     *
     * @param \App\Http\Model\Reservation|ObjectCollection $reservation The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildReservationstockeeQuery The current query, for fluid interface
     */
    public function filterByReservation($reservation, $comparison = null)
    {
        if ($reservation instanceof \App\Http\Model\Reservation) {
            return $this
                ->addUsingAlias(ReservationstockeeTableMap::COL_IDRESERVATION, $reservation->getId(), $comparison);
        } elseif ($reservation instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ReservationstockeeTableMap::COL_IDRESERVATION, $reservation->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildReservationstockeeQuery The current query, for fluid interface
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
     * Filter the query by a related \App\Http\Model\Pile object
     *
     * @param \App\Http\Model\Pile $pile The related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildReservationstockeeQuery The current query, for fluid interface
     */
    public function filterByPile($pile, $comparison = null)
    {
        if ($pile instanceof \App\Http\Model\Pile) {
            return $this
                ->addUsingAlias(ReservationstockeeTableMap::COL_NUMPILE, $pile->getNumpile(), $comparison)
                ->addUsingAlias(ReservationstockeeTableMap::COL_NUMTRAVEE, $pile->getNumtravee(), $comparison)
                ->addUsingAlias(ReservationstockeeTableMap::COL_CODEBLOC, $pile->getCodebloc(), $comparison);
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
     * @return $this|ChildReservationstockeeQuery The current query, for fluid interface
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
     * @param   ChildReservationstockee $reservationstockee Object to remove from the list of results
     *
     * @return $this|ChildReservationstockeeQuery The current query, for fluid interface
     */
    public function prune($reservationstockee = null)
    {
        if ($reservationstockee) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ReservationstockeeTableMap::COL_NUMPILE), $reservationstockee->getNumpile(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ReservationstockeeTableMap::COL_NUMTRAVEE), $reservationstockee->getNumtravee(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(ReservationstockeeTableMap::COL_CODEBLOC), $reservationstockee->getCodebloc(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond3', $this->getAliasedColName(ReservationstockeeTableMap::COL_IDRESERVATION), $reservationstockee->getIdreservation(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2', 'pruneCond3'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the reservationStockee table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReservationstockeeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ReservationstockeeTableMap::clearInstancePool();
            ReservationstockeeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ReservationstockeeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ReservationstockeeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ReservationstockeeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ReservationstockeeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ReservationstockeeQuery
