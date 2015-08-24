<?php
/**
 * CRUD Model
 *
 * A Simple CRUD model
 * - Must have a primary key in your table
 * - Enabled: get, insert, update, insertUpdate, delete to any Model/Table.
 * - Place in your ~/application/model/ folder and extend your models!
 * - Optionally add to ~/application/config/autoload.php: $autoload['model']
 *
 * @author       Jesse Boyer <contact@jream.com>
 * @author       Tim Santor <tsantor@xstudiosinc.com>
 * @version      1.5
 *
 * @usage:
 *
 *  class User_Model extends CRUD_model {
 *
 *      $_table       = 'user';
 *      $_primary_key = 'user_id';'
 *
 *      // Optional Fetch mode (Default is array)
 *      $_fetch_mode = 'object|array';
 *
 *      public function __construct() {
 *          parent::__construct();
 *      }
 *  }
 *
 * Use without Model
 *
 * $crud = new CRUD_model();
 * $crud->setOptions('user', 'user_id');
 * $crud->get();
 *
 * @examples:
 *
 *  GET ALL
 *      $this->user_model->get();
 *
 *  GET PK (defined in your model) is 25
 *      $this->user_model->get(25);
 *
 *  GET CUSTOM COLUMN
 *      $this->user_model->get('email', 'test@test.com');
 *
 *  GET ALL WHERE
 *      $this->user_model->get(array('user_type'=>'admin', 'other' => 1));
 *
 *  INSERT
 *      $this->user_model->insert(['name' => 'jesse', 'age' => 28]);
 *
 *  UPDATE PK (defined in your model) is 12
 *      $this->user_model->update(['age' => 29], 12);
 *
 *  UPDATE CUSTOM COLUMN
 *      $this->user_model->update(['age' => 0], 'name', 'jesse');
 *
 *  DELETE (defined in your model) is 17
 *      $this->user_model->delete(17);
 *
 *  DELETE CUSTOM COLUMN
 *      $this->user_model->delete(['age' => 29]);
 *
 */

class CRUD_model extends CI_Model {

    // ------------------------------------------------------------------------

    protected $_table;
    protected $_primary_key;
    // ------------------------------------------------------------------------

    /**
     * Change the fetch mode if desired
     *
     * @var string $_fetch_mode Optionally set to 'object', default is array
     */
    protected $_fetch_mode = 'array';

    // ------------------------------------------------------------------------

    /**
     * Construct the CI_Model
     */
    public function __construct() {
        parent::__construct();

        $this->load->database();
    }

    // ------------------------------------------------------------------------

    /**
     * For using the class without a model
     *
     * @param string $table  Name of the table
     * @param string $primary_key  Name of the tables Primary Key
     */
    public function setOptions($table, $primary_key = false)
    {
        $this->_table = $table;
        $this->_primary_key = $primary_key;
    }

    // ------------------------------------------------------------------------

    /**
     * Grabs data from a table
     *       OR a single record by passing $id,
     *       OR a different field than the primary_key by passing two paramters
     *       OR by passing an array
     *
     * @param integer|string $id_or_row (Optional)
     *           null    = Fetch all table records
     *           number  = Fetch where primary key = $id
     *           string  = Fetch based on a different column name
     *           array   = Fetch based on array criteria
     *
     * @param integer|string $optional_value (Optional)
     * @param string         $order_by (Optional)
     *
     * @return object database results
     */
    public function get($id_or_row = null, $optional_value = null, $order_by = null)
    {
        // Custom order by if desired
        if ($order_by != null) {
            $this->db->order_by($order_by);
        }

        // Fetch all records for a table
        if ($id_or_row == null) {
            $query = $this->db->get($this->_table);
        } elseif (is_array($id_or_row)) {
            $query = $this->db->get_where($this->_table, $id_or_row);
        } else {
            if ($optional_value == null) {
                $query = $this->db->get_where($this->_table, array($this->_primary_key => $id_or_row));
            } else {
                $query = $this->db->get_where($this->_table, array($id_or_row => $optional_value));
            }
        }

        if ($this->_fetch_mode == 'array') {
            return $query->result_array();
        } else {
            return $query->result();
        }
    }

    // ------------------------------------------------------------------------

    /**
     * Creates a record
     *
     * @usage  insert(['name' => 'jesse', 'age' => 28])
     *
     * @param     array    $data key value pair of mySQL fields
     *
     * @return    integer  insert id
     */
    public function insert($data)
    {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    // ------------------------------------------------------------------------

    /**
     * Update a record
     *
     * @usage   update(['age' => 29], 12);
     *          update(['age' => 0], 'name', 'jesse');
     *
     * @param  array    $data key/value pair to update
     * @param  integer  $id_or_row (Optional)
     * @param  array    $data
     *
     * @return    boolean result
     */
    public function update($data, $id_or_row, $optional_value = null)
    {
        if ($optional_value == null) {
            if (is_array($id_or_row)) {
                $this->db->where($id_or_row);
            } else {
                $this->db->where(array($this->_primary_key => $id_or_row));
            }
        } else {
            $this->db->where(array($id_or_row => $optional_value));
        }

        return $this->db->update($this->_table, $data);
    }

    // ------------------------------------------------------------------------

    /**
     * Insert if not exists, if exists Update
     *
     * @usage   insertUpdate(['item' => 10], 25)
     *          insertUpdate(['item' => 10], 'other_key' => 25)
     *
     * @param array $data Associative array [column => value]
     *
     * @param   integer|string $id_or_row (Optional)
     *           null    = Fetch all table records
     *           number  = Fetch where primary key = $id
     *           string  = Fetch based on a different column name
     *
     * @param integer|string $optional_value (Optional)
     *
     * @return integer InsertID|Update Result
     */
    public function insertUpdate($data, $id_or_row, $optional_value = null)
    {
        // First check to see if the field exists
        $this->db->select($this->_primary_key);

        if ($optional_value == null) {
            $query = $this->db->get_where($this->_table, array($this->_primary_key => $id_or_row));
        } else {
            $query = $this->db->get_where($this->_table, array($id_or_row => $optional_value));
        }

        // Count how many records exist with this ID
        $result = $query->num_rows();

        // INSERT
        if ($result == 0)
        {
            $this->db->insert($this->_table, $data);
            return $this->db->insert_id();
        }

        // UPDATE
        if ($optional_value == null) {
            $this->db->where($this->_primary_key, $id_or_row);
        } else {
            $this->db->where($id_or_row, $optional_value);
        }

        return $this->db->update($this->_table, $data);
    }

    // ------------------------------------------------------------------------

    /**
     * Delete a record
     *
     * @usage   delete(12)
     *          delete('email', 'test@test.com')
     *          delete(array(
     *              'name' => 'ted',
     *              'age' => 25
     *          ));
     *
     * @param   integer|string|array $id_or_row (Optional)
     *          number  = Delete primary key ID
     *          string  = Column Name
     *          array   = key/value pairs
     *
     * @param integer|string|array $optional_value
     *              (Optional) Use when first param is string
     *
     * @return boolean result
     */
    public function delete($id_or_row, $optional_value = null)
    {
        if ($optional_value == null) {
            if (is_array($id_or_row)) {
                $this->db->where($id_or_row);
            } else {
                $this->db->where(array($this->_primary_key => $id_or_row));
            }
        } else {
            $this->db->where($id_or_row, $optional_value);
        }

        return $this->db->delete($this->_table);
    }

    // ------------------------------------------------------------------------

    /**
     * Get the total records in the table
     *
     * @param  string|array  $where
     * @return integer
     */
    public function get_total($where = null)
    {
        if (!empty($where)) {
            $this->db->where($where);
        }

        $this->db->from($this->_table);
        return $this->db->count_all_results();
    }

    // ------------------------------------------------------------------------

}
/** End of File */