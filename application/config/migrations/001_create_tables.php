<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_tables extends CI_Migration
{
    public function up()
    {
      // Create Seller_types
        $this->dbforge->add_field(
           array(
              'id' => array(
                 'type' => 'INT',
                 'constraint' => 11,
                 'auto_increment' => true
              ),
              'type' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '100',
              )
           )
        );

        $this->dbforge->add_field("created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("updated timestamp ON UPDATE CURRENT_TIMESTAMP");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('seller_types');

        // Create vehicle_types
        $this->dbforge->add_field(
           array(
              'id' => array(
                 'type' => 'INT',
                 'constraint' => 11,
                 'auto_increment' => true
              ),
              'vehicle_type' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '255',
              )
           )
        );

        $this->dbforge->add_field("created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("updated timestamp ON UPDATE CURRENT_TIMESTAMP");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('vehicle_types');

         // Create vehicles
          $this->dbforge->add_field(
           array(
              'id' => array(
                 'type' => 'INT',
                 'constraint' => 11,
                 'auto_increment' => true
              ),
              'vehicle_type_id' => array(
                 'type' => 'INT',
                 'constraint' => 11
              ),
              'registered_year' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '20',
              ),
              'make' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '255',
              ),
              'model' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '255',
              ),
              'description' => array(
                 'type' => 'TEXT',
                 'null' => true,
              ),
              'price' => array(
                 'type' => 'FLOAT',
                 'default' => 0,
              ),
              'primary_image' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '255',
                 'null' => true
              ),
              'metadata' => array(
                 'type' => 'LONGTEXT',
                 'null' => true
              )
           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field("created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("updated timestamp ON UPDATE CURRENT_TIMESTAMP");
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (vehicle_type_id) REFERENCES vehicle_types(id) ON DELETE CASCADE');
        $this->dbforge->create_table('vehicles');

         // Create sellers
        $this->dbforge->add_field(
           array(
              'id' => array(
                 'type' => 'INT',
                 'constraint' => 11,
                 'auto_increment' => true
              ),
              'seller_type_id' => array(
                 'type' => 'INT',
                 'constraint' => 11
              ),
              'name' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '100',
              ),
              'address' => array(
                 'type' => 'TEXT',
                 'null' => true,
              ),
              'contact' => array(
                 'type' => 'BIGINT',
                 'default' => '0',
              ),
              'email' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '255'
              ),
              'website' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '255',
                 'null' => true
              )
           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field("created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("updated timestamp ON UPDATE CURRENT_TIMESTAMP");
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (seller_type_id) REFERENCES seller_types(id) ON DELETE CASCADE');
        $this->dbforge->create_table('sellers');

         // Create seller_reviews
          $this->dbforge->add_field(
           array(
              'id' => array(
                 'type' => 'INT',
                 'constraint' => 11,
                 'auto_increment' => true
              ),
              'seller_id' => array(
                 'type' => 'INT',
                 'constraint' => 11
              ),
              'review' => array(
                 'type' => 'TEXT',
              )
           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field("created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("updated timestamp ON UPDATE CURRENT_TIMESTAMP");
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (seller_id) REFERENCES sellers(id) ON DELETE CASCADE');
        $this->dbforge->create_table('seller_reviews');

         // Create vehicle_seller
         $this->dbforge->add_field(
           array(
              'id' => array(
                 'type' => 'INT',
                 'constraint' => 11,
                 'auto_increment' => true
              ),
              'seller_id' => array(
                 'type' => 'INT',
                 'constraint' => 11
              ),
             'vehicle_id' => array(
                 'type' => 'INT',
                 'constraint' => 11
              ),
           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field("created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("updated timestamp ON UPDATE CURRENT_TIMESTAMP");
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (seller_id) REFERENCES sellers(id) ON DELETE CASCADE');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON DELETE CASCADE');
        $this->dbforge->create_table('vehicle_seller');

        // Inserting master data into seller_types table
         $data = array(
            array('type' => "Dealer"),
            array('type' => "Broker"),
            array('type' => "Private Party"),
         );
         $this->db->insert_batch('seller_types', $data);

         // Inserting master data into vehicle_types table
         $data = array(
            array('vehicle_type' => "Motor Cycle"),
            array('vehicle_type' => "Truck"),
            array('vehicle_type' => "Private Party"),
            array('vehicle_type' => "RV")
         );
         $this->db->insert_batch('vehicle_types', $data);

         // Inserting data into sellers table
         $data = array(
            array('seller_type_id' => "1",'name' => "Anthony",
                  'address' => "Karnataka,madiwala,560078",'contact' => "888567890",
                  'email' => "anthony@gmail.com",'website' => "www.anthony.com"
                ),
          array('seller_type_id' => "2",'name' => "Marley",
                  'address' => "Andhra,vizag,532222",'contact' => "8885432100",
                  'email' => "marley@gmail.com",'website' => "www.marley.com"
                ),
         );
         $this->db->insert_batch('sellers', $data);

        // Inserting data into vehicles table
         $data = array(
            array('vehicle_type_id' => "1",'registered_year' => "2012",
                  'make' => "IGP BMW R1800C Diecast",'model' => "1:12 Scale Alloy Model Racing Motorcycle",
                  'description' => "IGP BMW R1800C Diecast 1:12 Scale Alloy Model Racing Motorcycle Silver Grey",'price' => "20000",
                  'primary_image' => "http://task.local/uploads/R1800C.png",'metadata' => "{'metadata':{'image1':'http://task.local/uploads/R1800C_samll.png','color':'Silver Grey','material':'Diecast Metal & Plastic/Made Of Environmental Friendly Non Toxic Material'}} "
                ),
           array('vehicle_type_id' => "1",'registered_year' => "2014",
                  'make' => "Maisto Ducati 1199 Panigale",'model' => "1:18 Scale Diecast Motorcycle",
                  'description' => "Maisto Ducati 1199 Panigale -1:18 Scale Diecast Motorcycle",'price' => "10000",
                  'primary_image' => "http://task.local/uploads/maisto.png",'metadata' => "{'metadata':{'image1':'http://task.local/uploads/maisto_small.png','color':'balck &red','material':'Detailed Construction With Frame'}}"
                ),
           array('vehicle_type_id' => "2",'registered_year' => "2017",
                  'make' => "Revell 1/25 Ford Bronco Plastic",'model' => "Model Kit 85-4320 Rmx854320",
                  'description' => "REVELL - (1966-1977 STYLE) FORD BRONCO 4X4 - MODEL KIT NIB Factory Sealed",'price' => "30000",
                  'primary_image' => "http://task.local/uploads/bronco.png",'metadata' => "{'metadata':{'color':'blue','image1':'http://task.local/uploads/bronco_small.png'}}"
                ),
         );
         $this->db->insert_batch('vehicles', $data);

         // Inserting data into seller_reviews table
          $data = array(
            array('seller_id' => "1",'review' => "99.9% Positive feedback"),
            array('seller_id' => "2",'review' => "90.8% Positive feedback"),
         );
         $this->db->insert_batch('seller_reviews', $data);

          // Inserting data into vehicle_seller table
          $data = array(
            array('seller_id' => "1",'vehicle_id' => "1"),
            array('seller_id' => "1",'vehicle_id' => "2"),
            array('seller_id' => "2",'vehicle_id' => "3")
         );
         $this->db->insert_batch('vehicle_seller', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('migrations');
    }
}

?>