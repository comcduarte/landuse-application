<?php
namespace Application\Model;

use Components\Model\AbstractBaseModel;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Sql\Ddl\CreateTable;
use Laminas\Db\Sql\Ddl\DropTable;
use Laminas\Db\Sql\Ddl\Column\Datetime;
use Laminas\Db\Sql\Ddl\Column\Integer;
use Laminas\Db\Sql\Ddl\Column\Varchar;
use Laminas\Db\Sql\Ddl\Constraint\PrimaryKey;

class ParcelModel extends AbstractBaseModel
{
    /******************************
     * Fields from Vision Software
     ******************************/
    public $PARCEL_ID;
    public $PARCEL_NAME;
    
    /******************************
     * Fields from Census.gov
     ******************************/
    public $STREET_NUM;
    public $STREET_NAME;
    public $STREET_SUFFIX_TYPE;
    
    /******************************
     * Fields from Application
     ******************************/
    public $TAX_ID_NUM;
    public $MAP_1;
    public $BLOCK_1;
    public $LOT_1;
    public $MAP_2;
    public $BLOCK_2;
    public $LOT_2;
    
    public $ZONE_DESIGNATION;
    
    public function __construct(Adapter $adapter)
    {
        parent::__construct($adapter);
        
        $this->setTableName('parcels');
        return $this;
    }
    
    private function clearDatabase()
    {
        $sql = new Sql($this->adapter);
        $ddl = [];
        
        $ddl[] = new DropTable($this->getTableName());
        
        foreach ($ddl as $obj) {
            $this->adapter->query($sql->buildSqlString($obj), $this->adapter::QUERY_MODE_EXECUTE);
        }
        
//         $this->clearSettings('PARCELS');
    }
    
    private function createDatabase()
    {
        $sql = new Sql($this->adapter);
        
        /******************************
         * APPLICATION TYPES
         ******************************/
        $ddl = new CreateTable($this->getTableName());
        
        $ddl->addColumn(new Varchar('UUID', 36));
        $ddl->addColumn(new Integer('STATUS', TRUE));
        $ddl->addColumn(new Datetime('DATE_CREATED', TRUE));
        $ddl->addColumn(new Datetime('DATE_MODIFIED', TRUE));
        
        $ddl->addColumn(new Varchar('PARCEL_ID', 36, TRUE));
        $ddl->addColumn(new Varchar('PARCEL_NAME', 36, TRUE));
        $ddl->addColumn(new Varchar('STREET_NUM', 36, TRUE));
        $ddl->addColumn(new Varchar('STREET_NAME', 36, TRUE));
        $ddl->addColumn(new Varchar('STREET_SUFFIX_TYPE', 36, TRUE));
        $ddl->addColumn(new Varchar('TAX_ID_NUM', 36, TRUE));
        $ddl->addColumn(new Varchar('MAP_1', 36, TRUE));
        $ddl->addColumn(new Varchar('BLOCK_1', 36, TRUE));
        $ddl->addColumn(new Varchar('LOT_1', 36, TRUE));
        $ddl->addColumn(new Varchar('MAP_2', 36, TRUE));
        $ddl->addColumn(new Varchar('BLOCK_2', 36, TRUE));
        $ddl->addColumn(new Varchar('LOT_2', 36, TRUE));
        $ddl->addColumn(new Varchar('ZONE_DESIGNATION', 36, TRUE));
        
        $ddl->addConstraint(new PrimaryKey('UUID'));
        
        $this->adapter->query($sql->buildSqlString($ddl), $this->adapter::QUERY_MODE_EXECUTE);
        unset($ddl);
    }
}