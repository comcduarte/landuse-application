<?php
namespace Application\Controller;

use Components\Controller\AbstractConfigController;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Sql\Ddl\CreateTable;
use Laminas\Db\Sql\Ddl\DropTable;
use Laminas\Db\Sql\Ddl\Column\Datetime;
use Laminas\Db\Sql\Ddl\Column\Integer;
use Laminas\Db\Sql\Ddl\Column\Varchar;
use Laminas\Db\Sql\Ddl\Constraint\PrimaryKey;

class ConfigController extends AbstractConfigController
{
    public function clearDatabase()
    {
        $sql = new Sql($this->adapter);
        $ddl = [];
        
        $ddl[] = new DropTable('application_types');
        $ddl[] = new DropTable('parcels');
        
        foreach ($ddl as $obj) {
            $this->adapter->query($sql->buildSqlString($obj), $this->adapter::QUERY_MODE_EXECUTE);
        }
        
        $this->clearSettings('LANDUSE');
    }

    public function createDatabase()
    {
        $sql = new Sql($this->adapter);
        
        /******************************
         * APPLICATION TYPES
         ******************************/
        $ddl = new CreateTable('application_types');
        
        $ddl->addColumn(new Varchar('UUID', 36));
        $ddl->addColumn(new Integer('STATUS', TRUE));
        $ddl->addColumn(new Datetime('DATE_CREATED', TRUE));
        $ddl->addColumn(new Datetime('DATE_MODIFIED', TRUE));
        
        $ddl->addColumn(new Varchar('NAME', 100, TRUE));
        
        $ddl->addConstraint(new PrimaryKey('UUID'));
        
        $this->adapter->query($sql->buildSqlString($ddl), $this->adapter::QUERY_MODE_EXECUTE);
        unset($ddl);
        
        /******************************
         * PARCELS
         ******************************/
        $ddl = new CreateTable('parcels');
        
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
        
        /******************************
         * ZONE DESIGNATIONS
         ******************************/
        $ddl = new CreateTable('zone_designations');
        
        $ddl->addColumn(new Varchar('UUID', 36));
        $ddl->addColumn(new Integer('STATUS', TRUE));
        $ddl->addColumn(new Datetime('DATE_CREATED', TRUE));
        $ddl->addColumn(new Datetime('DATE_MODIFIED', TRUE));
        
        $ddl->addColumn(new Varchar('NAME', 100, TRUE));
        
        $ddl->addConstraint(new PrimaryKey('UUID'));
        
        $this->adapter->query($sql->buildSqlString($ddl), $this->adapter::QUERY_MODE_EXECUTE);
        unset($ddl);
        
        unset($sql);
    }
}