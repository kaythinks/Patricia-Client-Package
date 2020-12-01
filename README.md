# Pat-Client-Package
PHP library for Patricia Technologies for management of client and client key 

 
# Installation 
```sh
composer install pinkcode15/pat-client-package


```

```
require_once 'vendor/autoload.php';
```

```
use PatriciaClient\Patricia;
$patricia = new Patricia();
```

### `Create Client`

      Patricia::create_client(String $clientName)  
      or
      $patricia->create_client(String $clientName)
      

### `Create Client Key`

    Patricia::create_client_key(int $clientId, String $clientKeyName);
    $patricia->create_client_key(int $clientId, String $clientKeyName);
     
### `Update Client`
    Patricia::update_client(string $ClientUuid, array $array);
    $patricia->update_client(string $ClientUuid, array $array);

    $array should contain the columns and respective values;
    example $array = [
        'name' => 'Patricia King',
        'is_blocked' => 1
    ];

 
### `Update Client Keys`

    Patricia::update_client_keys(Int $clientKeyId, array $array);
    $patricia->update_client_keys(Int $clientKeyId, array $array);

    $array should contain the columns and respective values;
    example $array = [
        'name' => 'Patricia King Key',
        'is_blocked' => 1
    ];

 
### `Get Client Detail`

    get a client details based on column attribute

    Patricia::get_client(string $columnName, string $columnValue);
    $patricia->get_client(string $columnName, string $columnValue);

    $array should contain the columns and respective values;
    example $array = [
        'name' => 'Patricia King Key',
        'is_blocked' => 1
    ];

### `Get Client Keys Detail`

    returns all instances of a client key

    Patricia::get_client_keys(Int $clientKeyId);
    $patricia->get_client_keys(Int $clientKeyId);


### `Get Client key Detail`

    returns the first instance of a client key

    Patricia::get_client_key(Int $clientKeyId);
    $patricia->get_client_key(Int $clientKeyId);


### `Delete client`

    Patricia::delete_client(String $clientUuid);
    $patricia->delete_client(String $clientUuid);



### `Delete client key`

    Patricia::delete_client_key(Int $clientKeyId);
    $patricia->delete_client_key(Int $clientKeyId);



    
## License

    Released under the MIT License. See the bundled LICENSE file for details.

## Contributions
   
   Open to contributions from anyone, PR's can be made and would be accepted. Thanks
