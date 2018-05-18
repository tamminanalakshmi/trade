# Trade Market

  This Project contains Api's List
  * Vehicle types Listing for select box option in Vehicle list filters
  * Vehicle List with filters (vehicle type,keyword,low range,high range)
  * Vehicle Details it will give details about selected vehicle form the list
  * Sendmail to seller  when buyer want to express interest 

### Prerequisites

```
  1.PHP >= 5.6
  2.MySQL
```  

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes

```
	1.Create one database with name "test" (If you want cvhange database name then follow application/config/database.php  modify 'database' => 'test')

	2.application/config/config.php  Modify $config['base_url'] = 'http://localhost/trade'; according to your local repository

	3.Run url "http://localhost/trade/migration for database migration" in browser , This will create all required tables in database with sample data for testing purpose in test (database).
```

## Api URLs

 Vehicle Types List (for filter select box)

  ```
  url        : http://localhost/trade/vehicleTypes
  parameters : none
  method     : GET
  Output     : json
  sample data :
  {
    "success": true,
    "message": "Success",
    "result": [
        {
            "id": "1",
            "vehicle_type": "Motor Cycle"
        },
        {
            "id": "2",
            "vehicle_type": "Truck"
        },
        {
            "id": "3",
            "vehicle_type": "Private Party"
        },
        {
            "id": "4",
            "vehicle_type": "RV"
        }
    ]
}

  ```
 Vehicle list 

  ```
  url        : http://localhost/trade
  parameters : vehcile_type(this is vehicle id which is present in vehicle types),keyword,low_range,high_range
  method     : POST
  Output     : json
  sample data :
  {
    "success": true,
    "message": "Success",
    "vehicles": [
        {
            "vehicle_type": "Motor Cycle",
            "image": "http://localhost/trade/uploads/R1800C.png",
            "registered_year": "2012",
            "make": "IGP BMW R1800C Diecast",
            "model": "1:12 Scale Alloy Model Racing Motorcycle",
            "description": "IGP BMW R1800C Diecast 1:12 Scale Alloy Model Racing Motorcycle Silver Grey",
            "price": "20000",
            "metadata": "{'metadata':{'image1':'http://localhost/trade/uploads//R1800C_samll.png','color':'Silver Grey','material':'Diecast Metal & Plastic/Made Of Environmental Friendly Non Toxic Material'}} "
        },
        {
            "vehicle_type": "Motor Cycle",
            "image": "http://localhost/trade/uploads/maisto.png",
            "registered_year": "2014",
            "make": "Maisto Ducati 1199 Panigale",
            "model": "1:18 Scale Diecast Motorcycle",
            "description": "Maisto Ducati 1199 Panigale -1:18 Scale Diecast Motorcycle",
            "price": "10000",
            "metadata": "{'metadata':{'image1':'http://localhost/trade/uploads/maisto_small.png','color':'balck &red','material':'Detailed Construction With Frame'}}"
        },
        {
            "vehicle_type": "Truck",
            "image": "http://task.local/uploads/bronco.png",
            "registered_year": "2017",
            "make": "Revell 1/25 Ford Bronco Plastic",
            "model": "Model Kit 85-4320 Rmx854320",
            "description": "REVELL - (1966-1977 STYLE) FORD BRONCO 4X4 - MODEL KIT NIB Factory Sealed",
            "price": "30000",
            "metadata": "{'metadata':{'color':'blue','image1':'http://localhost/trade/uploads/bronco_small.png'}}"
        }
    ]
}
 ```
 Vehicle Details

  ```
  url        : http://localhost/trade/vehicle/vehicleDetails/{id} (vehicle id)
  method     : GET
  Output     : json
  sample data :
  {
    "success": true,
    "message": "Success",
    "details": {
        "vehicle_details": {
            "vehicle_type": "Motor Cycle",
            "registered_year": "2012",
            "make": "IGP BMW R1800C Diecast",
            "model": "1:12 Scale Alloy Model Racing Motorcycle",
            "primary_image": "http://localhost/trade/uploads/R1800C.png",
            "description": "IGP BMW R1800C Diecast 1:12 Scale Alloy Model Racing Motorcycle Silver Grey",
            "price": "20000",
            "metadata": "{'metadata':{'image1':'http://localhost/trade/uploads/R1800C_samll.png','color':'Silver Grey','material':'Diecast Metal & Plastic/Made Of Environmental Friendly Non Toxic Material'}} "
        },
        "seller_details": {
            "id": "1",
            "seller_type": "Dealer",
            "name": "Anthony",
            "address": "Karnataka,madiwala,560078",
            "contact": "888567890",
            "email": "anthony@gmail.com",
            "website": "www.anthony.com"
        },
        "seller_reviews": [
            {
                "review": "99.9% Positive feedback"
            }
        ]
    }
}

  ```

  SendEmail To Seller

   ```
  url        : http://localhost/trade/seller/sendMailToSeller
  parameters : seller_id,message
  method     : POST
  Output     : json
  sample data :
  {
    "success": true,
    "message": "Your interest sent to concern seller,soon you will get reply"
  }

  ```
