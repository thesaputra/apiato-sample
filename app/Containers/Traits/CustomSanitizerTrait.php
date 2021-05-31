<?php


namespace App\Containers\Traits;

use Illuminate\Support\Arr;
use Apiato\Core\Abstracts\Requests\Request;
use Apiato\Core\Abstracts\Transporters\Transporter;
use App\Ship\Exceptions\InternalErrorException;


trait CustomSanitizerTrait
{

    public function sanitizeCustomInput(array $fields)
    {
      $data = $this->getData();

      $search = [];
      foreach ($fields as $field) {

        // create a multidimensional array based on $fields
        // which was submitted as DOT notation (e.g., data.name)
        Arr::set($search, $field, true);
      }

      // check, if the keys exist in both arrays
      $data = $this->recursiveArrayIntersectKey($data, $search);

      return $data;
    }

    private function getData()
    {
      // get all request data
      if ($this instanceof Transporter) {
        $data = $this->toArray();
      } elseif ($this instanceof Request) {
        $data = $this->all();
      } else {
        throw new InternalErrorException('Unsupported class type for sanitization.');
      }

      return $data;
    }

    private function recursiveArrayIntersectKey(array $a, array $b)
    {

      $a = array_intersect_key($a, $b);

      $data = [];

      foreach ($a as $key => &$value) {

        $data[fromCamelCase($key)] = $value;

        if (is_array($value) && is_array($b[$key])) {
          $value = $this->recursiveArrayIntersectKey($value, $b[$key]);
        }

      }

      return $data;
    }

}
