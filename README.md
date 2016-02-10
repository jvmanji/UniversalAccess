# UniversalAccess

This package includes PHP wrapper for arrays and objects. When you get data from 3rd party API's you offten get into an "isset hell":

```php
    if (isset($result->profile) && 
        isset($result->profile->map_data) && 
        isset($result->profile->map_data->work_places)) {
      // do sth with: $result->profile->map_data->work_places
    }
```

By using this class you can do just:

```php
    use UniversalAccess\Wrapper as W;

    $data = W::wrap($result);

    if (isset($data->profile->map_data->work_places)) {
      $work_places = $data->profile->map_data->work_places->raw();
    }
```

## Examples
More examples are in examples directory.

## Todo
Add license
