<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Reservation as ChildReservation;
use App\Http\Model\ReservationQuery as ChildReservationQuery;
use App\Http\Model\Map\ReservationTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'reservation' table.
 *
 *
 *
 * @method     ChildReservationQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildReservationQuery orderByDatereservation($order = Criteria::ASC) Order by the dateReservation column
 * @method     ChildReservationQuery orderByDateprevuestockage($order = Criteria::ASC) Order by the datePrevueStockage column
 * @method     ChildReservationQuery orderByNbjoursdestockageprevu($order = Criteria::ASC) Order by the nbJoursDeStockagePrevu column
 * @method     ChildReservationQuery orderByQuantite($order = Criteria::ASC) Order by the quantite column
 * @method     ChildReservationQuery orderByEtat($order = Criteria::ASC) Order by the etat column
 * @method     ChildReservationQuery orderByNumclient($order = Criteria::ASC) Order by the numClient column
 *
 * @method     ChildReservationQuery groupById() Group by the id column
 * @method     ChildReservationQuery groupByDatereservation() Group by the dateReservation column
 * @method     ChildReservationQuery groupByDateprevuestockage() Group by the datePrevueStockage column
 * @method     ChildReservationQuery groupByNbjoursdestockageprevu() Group by the nbJoursDeStockagePrevu column
 * @method     ChildReservationQuery groupByQuantite() Group by the quantite column
 * @method     ChildReservationQuery groupByEtat() Group by the etat column
 * @method     ChildReservationQuery groupByNumclient() Group by the numClient column
 *
 * @method     ChildReservationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildReservationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildReservationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildReservationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildReservationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildReservationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildReservationQuery leftJoinUtilisateur($relationAlias = null) Adds a LEFT JOIN clause to the query using the Utilisateur relation
 * @method     ChildReservationQuery rightJoinUtilisateur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Utilisateur relation
 * @method     ChildReservationQuery innerJoinUtilisateur($relationAlias = null) Adds a INNER JOIN clause to the query using the Utilisateur relation
 *
 * @method     ChildReservationQuery joinWithUtilisateur($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Utilisateur relation
 *
 * @method     ChildReservationQuery leftJoinWithUtilisateur() Adds a LEFT JOIN clause and with to the query using the Utilisateur relation
 * @method     ChildReservationQuery rightJoinWithUtilisateur() Adds a RIGHT JOIN clause and with to the query using the Utilisateur relation
 * @method     ChildReservationQuery innerJoinWithUtilisateur() Adds a INNER JOIN clause and with to the query using the Utilisateur relation
 *
 * @method     ChildReservationQuery leftJoinReservationstockee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Reservationstockee relation
 * @method     ChildReservationQuery rightJoinReservationstockee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Reservationstockee relation
 * @method     ChildReservationQuery innerJoinReservationstockee($relationAlias = null) Adds a INNER JOIN clause to the query using the Reservationstockee relation
 *
 * @method     ChildReservationQuery joinWithReservationstockee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Reservationstockee relation
 *
 * @method     ChildReservationQuery leftJoinWithReservationstockee() Adds a LEFT JOIN clause and with to the query using the Reservationstockee relation
 * @method     ChildReservationQuery rightJoinWithReservationstockee() Adds a RIGHT JOIN clause and with to the query using the Reservationstockee relation
 * @method     ChildReservationQuery innerJoinWithReservationstockee() Adds a INNER JOIN clause and with to the query using the Reservationstockee relation
 *
 * @method     \App\Http\Model\UtilisateurQuery|\App\Http\Model\ReservationstockeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildReservation|null findOne(ConnectionInterface $con = null) Return the first ChildReservation matching the query
 * @method     ChildReservation findOneOrCreate(ConnectionInterface $con = null) Return the first ChildReservation matching the query, or a new ChildReservation object populated from the query conditions when no match is found
 *
 * @method     ChildReservation|null findOneById(int $id) Return the first ChildReservation filtered by the id column
 * @method     ChildReservation|null findOneByDatereservation(string $dateReservation) Return the first ChildReservation filtered by the dateReservation column
 * @method     ChildReservation|null findOneByDateprevuestockage(string $datePrevueStockage) Return the first ChildReservation filtered by the datePrevueStockage column
 * @method     ChildReservation|null findOneByNbjoursdestockageprevu(int $nbJoursDeStockagePrevu) Return the first ChildReservation filtered by the nbJoursDeStockagePrevu column
 * @method     ChildReservation|null findOneByQuantite(int $quantite) Return the first ChildReservation filtered by the quantite column
 * @method     ChildReservation|null findOneByEtat(string $etat) Return the first ChildReservation filtered by the etat column
 * @method     ChildReservation|null findOneByNumclient(int $numClient) Return the first ChildReservation filtered by the numClient column *

 * @method     ChildReservation requirePk($key, ConnectionInterface $con = null) Return the ChildReservation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservation requireOne(ConnectionInterface $con = null) Return the first ChildReservation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReservation requireOneById(int $id) Return the first ChildReservation filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservation requireOneByDatereservation(string $dateReservation) Return the first ChildReservation filtered by the dateReservation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservation requireOneByDateprevuestockage(string $datePrevueStockage) Return the first ChildReservation filtered by the datePrevueStockage column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservation requireOneByNbjoursdestockageprevu(int $nbJoursDeStockagePrevu) Return the first ChildReservation filtered by the nbJoursDeStockagePrevu column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservation requireOneByQuantite(int $quantite) Return the first ChildReservation filtered by the quantite column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservation requireOneByEtat(string $etat) Return the first ChildReservation filtered by the etat column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservation requireOneByNumclient(int $numClient) Return the first ChildReservation filtered by the numClient column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReservation[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildReservation objects based on current ModelCriteria
 * @method     ChildReservation[]|ObjectCollection findById(int $id) Return ChildReservation objects filtered by the id column
 * @method     ChildReservation[]|ObjectCollection findByDatereservation(string $dateReservation) Return ChildReservation objects filtered by the dateReservation column
 * @method     ChildReservation[]|ObjectCollection findByDateprevuestockage(string $datePrevueStockage) Return ChildReservation objects filtered by the datePrevueStockage column
 * @method     ChildReservation[]|ObjectCollection findByNbjoursdestockageprevu(int $nbJoursDeStockagePrevu) Return ChildReservation objects filtered by the nbJoursDeStockagePrevu column
 * @method     ChildReservation[]|ObjectCollection findByQuantite(int $quantite) Return ChildReservation objects filtered by the quantite column
 * @method     ChildReservation[]|ObjectCollection findByEtat(string $etat) Return ChildReservation objects filtered by the etat column
 * @method     ChildReservation[]|ObjectCollection findByNumclient(int $numClient) Return ChildReservation objects filtered by the numClient column
 * @method     ChildReservation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ReservationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Http\Model\Base\ReservationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ws-zstockage-connection', $modelName = '\\App\\Http\\Model\\Reservation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildReservationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildReservationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildReservationQuery) {
            return $criteria;
        }
        $query = new ChildReservationQuery();
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
     * @return ChildReservation|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ReservationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ReservationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildReservation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, dateReservation, datePrevueStockage, nbJoursDeStockagePrevu, quantite, etat, numClient FROM reservation WHERE id = :p0';
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
            /** @var ChildReservation $obj */
            $obj = new ChildReservation();
            $obj->hydrate($row);
            ReservationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildReservation|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildReservationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ReservationTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildReservationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ReservationTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReservationQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ReservationTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ReservationTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReservationTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the dateReservation column
     *
     * Example usage:
     * <code>
     * $query->filterByDatereservation('2011-03-14'); // WHERE dateReservation = '2011-03-14'
     * $query->filterByDatereservation('now'); // WHERE dateReservation = '2011-03-14'
     * $query->filterByDatereservation(array('max' => 'yesterday')); // WHERE dateReservation > '2011-03-13'
     * </code>
     *
     * @param     mixed $datereservation The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReservationQuery The current query, for fluid interface
     */
    public function filterByDatereservation($datereservation = null, $comparison = null)
    {
        if (is_array($datereservation)) {
            $useMinMax = false;
            if (isset($datereservation['min'])) {
                $this->addUsingAlias(ReservationTableMap::COL_DATERESERVATION, $datereservation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datereservation['max'])) {
                $this->addUsingAlias(ReservationTableMap::COL_DATERESERVATION, $datereservation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReservationTableMap::COL_DATERESERVATION, $datereservation, $comparison);
    }

    /**
     * Filter the query on the datePrevueStockage column
     *
     * Example usage:
     * <code>
     * $query->filterByDateprevuestockage('2011-03-14'); // WHERE datePrevueStockage = '2011-03-14'
     * $query->filterByDateprevuestockage('now'); // WHERE datePrevueStockage = '2011-03-14'
     * $query->filterByDateprevuestockage(array('max' => 'yesterday')); // WHERE datePrevueStockage > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateprevuestockage The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReservationQuery The current query, for fluid interface
     */
    public function filterByDateprevuestockage($dateprevuestockage = null, $comparison = null)
    {
        if (is_array($dateprevuestockage)) {
            $useMinMax = false;
            if (isset($dateprevuestockage['min'])) {
                $this->addUsingAlias(ReservationTableMap::COL_DATEPREVUESTOCKAGE, $dateprevuestockage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateprevuestockage['max'])) {
                $this->addUsingAlias(ReservationTableMap::COL_DATEPREVUESTOCKAGE, $dateprevuestockage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReservationTableMap::COL_DATEPREVUESTOCKAGE, $dateprevuestockage, $comparison);
    }

    /**
     * Filter the query on the nbJoursDeStockagePrevu column
     *
     * Example usage:
     * <code>
     * $query->filterByNbjoursdestockageprevu(1234); // WHERE nbJoursDeStockagePrevu = 1234
     * $query->filterByNbjoursdestockageprevu(array(12, 34)); // WHERE nbJoursDeStockagePrevu IN (12, 34)
     * $query->filterByNbjoursdestockageprevu(array('min' => 12)); // WHERE nbJoursDeStockagePrevu > 12
     * </code>
     *
     * @param     mixed $nbjoursdestockageprevu The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReservationQuery The current query, for fluid interface
     */
    public function filterByNbjoursdestockageprevu($nbjoursdestockageprevu = null, $comparison = null)
    {
        if (is_array($nbjoursdestockageprevu)) {
            $useMinMax = false;
            if (isset($nbjoursdestockageprevu['min'])) {
                $this->addUsingAlias(ReservationTableMap::COL_NBJOURSDESTOCKAGEPREVU, $nbjoursdestockageprevu['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nbjoursdestockageprevu['max'])) {
                $this->addUsingAlias(ReservationTableMap::COL_NBJOURSDESTOCKAGEPREVU, $nbjoursdestockageprevu['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReservationTableMap::COL_NBJOURSDESTOCKAGEPREVU, $nbjoursdestockageprevu, $comparison);
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
     * @return $this|ChildReservationQuery The current query, for fluid interface
     */
    public function filterByQuantite($quantite = null, $comparison = null)
    {
        if (is_array($quantite)) {
            $useMinMax = false;
            if (isset($quantite['min'])) {
                $this->addUsingAlias(ReservationTableMap::COL_QUANTITE, $quantite['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantite['max'])) {
                $this->addUsingAlias(ReservationTableMap::COL_QUANTITE, $quantite['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReservationTableMap::COL_QUANTITE, $quantite, $comparison);
    }

    /**
     * Filter the query on the etat column
     *
     * Example usage:
     * <code>
     * $query->filterByEtat('fooValue');   // WHERE etat = 'fooValue'
     * $query->filterByEtat('%fooValue%', Criteria::LIKE); // WHERE etat LIKE '%fooValue%'
     * </code>
     *
     * @param     string $etat The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReservationQuery The current query, for fluid interface
     */
    public function filterByEtat($etat = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($etat)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReservationTableMap::COL_ETAT, $etat, $comparison);
    }

    /**
     * Filter the query on the numClient column
     *
     * Example usage:
     * <code>
     * $query->filterByNumclient(1234); // WHERE numClient = 1234
     * $query->filterByNumclient(array(12, 34)); // WHERE numClient IN (12, 34)
     * $query->filterByNumclient(array('min' => 12)); // WHERE numClient > 12
     * </code>
     *
     * @see       filterByUtilisateur()
     *
     * @param     mixed $numclient The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReservationQuery The current query, for fluid interface
     */
    public function filterByNumclient($numclient = null, $comparison = null)
    {
        if (is_array($numclient)) {
            $useMinMax = false;
            if (isset($numclient['min'])) {
                $this->addUsingAlias(ReservationTableMap::COL_NUMCLIENT, $numclient['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($numclient['max'])) {
                $this->addUsingAlias(ReservationTableMap::COL_NUMCLIENT, $numclient['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReservationTableMap::COL_NUMCLIENT, $numclient, $comparison);
    }

    /**
     * Filter the query by a related \App\Http\Model\Utilisateur object
     *
     * @param \App\Http\Model\Utilisateur|ObjectCollection $utilisateur The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildReservationQuery The current query, for fluid interface
     */
    public function filterByUtilisateur($utilisateur, $comparison = null)
    {
        if ($utilisateur instanceof \App\Http\Model\Utilisateur) {
            return $this
                ->addUsingAlias(ReservationTableMap::COL_NUMCLIENT, $utilisateur->getNumutilisateur(), $comparison);
        } elseif ($utilisateur instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ReservationTableMap::COL_NUMCLIENT, $utilisateur->toKeyValue('PrimaryKey', 'Numutilisateur'), $comparison);
        } else {
            throw new PropelException('filterByUtilisateur() only accepts arguments of type \App\Http\Model\Utilisateur or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Utilisateur relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildReservationQuery The current query, for fluid interface
     */
    public function joinUtilisateur($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Utilisateur');

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
            $this->addJoinObject($join, 'Utilisateur');
        }

        return $this;
    }

    /**
     * Use the Utilisateur relation Utilisateur object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\UtilisateurQuery A secondary query class using the current class as primary query
     */
    public function useUtilisateurQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUtilisateur($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Utilisateur', '\App\Http\Model\UtilisateurQuery');
    }

    /**
     * Use the Utilisateur relation Utilisateur object
     *
     * @param callable(\App\Http\Model\UtilisateurQuery):\App\Http\Model\UtilisateurQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUtilisateurQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUtilisateurQuery(
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
     * @return ChildReservationQuery The current query, for fluid interface
     */
    public function filterByReservationstockee($reservationstockee, $comparison = null)
    {
        if ($reservationstockee instanceof \App\Http\Model\Reservationstockee) {
            return $this
                ->addUsingAlias(ReservationTableMap::COL_ID, $reservationstockee->getIdreservation(), $comparison);
        } elseif ($reservationstockee instanceof ObjectCollection) {
            return $this
                ->useReservationstockeeQuery()
                ->filterByPrimaryKeys($reservationstockee->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByReservationstockee() only accepts arguments of type \App\Http\Model\Reservationstockee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Reservationstockee relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildReservationQuery The current query, for fluid interface
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
     * @param   ChildReservation $reservation Object to remove from the list of results
     *
     * @return $this|ChildReservationQuery The current query, for fluid interface
     */
    public function prune($reservation = null)
    {
        if ($reservation) {
            $this->addUsingAlias(ReservationTableMap::COL_ID, $reservation->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the reservation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReservationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ReservationTableMap::clearInstancePool();
            ReservationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ReservationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ReservationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ReservationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ReservationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ReservationQuery
