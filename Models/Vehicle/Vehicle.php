<?php

namespace SmartCarBazar\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use \Exception as Exception;

class Vehicle extends BaseModel {

    use SoftDeletes;

    protected $morphClass = 'vehicle';
    protected $table = 'vehicle';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $fillable = ['name', 'category_id', 'model_id', 'description', 'price', 'meta_title', 'meta_keywords', 'meta_description', 'is_active', 'created_by', 'updated_by'];
    public $timestamps = true;

    public function model() {
        return $this->hasMany('SmartCarBazar\Models\Brand\Model');
    }

    public function features() {
        return $this->belongsToMany('SmartCarBazar\Models\Feature', 'vehicle_features');
    }

    public function photos() {
        return $this->morphMany('SmartCarBazar\Models\Photo', 'imageable');
    }

    public function add($data, $corporate_id = 0) {
        $returnResponse = ['status' => 1, 'code' => null, 'msg' => null];
        try {
            $vehicle = self::create($data);
            if ($vehicle) {
                $returnResponse['status'] = 1;
                $returnResponse['id'] = $vehicle;
            } else {
                $returnResponse['status'] = 0;
            }
        } catch (Exception $e) {
            $returnResponse['status'] = 0;
            $returnResponse['code'] = $e->getCode();
            $returnResponse['msg'] = 'There is some error Please try After some time';
        }
        return $returnResponse;
    }

    public function view($id, $active = true, $fields = array(), $with = array()) {
        $query = $this::newQuery();

        if ($with) {
            $with = $this->processWithSelects($with);
            $query->with($with);
        }

        if ($active)
            $query->where($this->table . '.is_active', '=', 1);

        $query->where($this->table . '.id', '=', $id);

        if (!$fields)
            $fields = array($this->table . '.*');
        try {
            $response = $query->first($fields);
            return $response;
        } catch (Exception $e) {
            //$this->validations->add('error', Lang::get('messages.crud.failed', array('action' => 'Read')));
            throw new DBException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
        return null;
    }

    public function edit($id, $data) {
        $feature = $data['features'];
        unset($data['features']);
        $vehicle = $this::find($id);
        $returnResponse = ['status' => 1, 'code' => null, 'msg' => null];
        try {
            $vehicle->update($data);
            $vehicle->features()->sync(explode(',', $feature));
            if($vehicle->photos()->count()==0){
                $returnResponse['status'] = 0;
                $returnResponse['id'] = $vehicle->id;
                $returnResponse['tab'] ='images' ;
                $returnResponse['error'] = 'Please upload min 1 photo';
            }
            elseif ($vehicle->features()->count()==0) {
                $returnResponse['status'] = 0;
                $returnResponse['id'] = $vehicle->id;
                $returnResponse['tab'] ='images' ;
                $returnResponse['error'] = 'Please select min 1 feature in each category';
            } else {
                $returnResponse['status'] = 1;
                $returnResponse['id'] = $vehicle->id;
            }
        } catch (Exception $e) {
            $returnResponse['status'] = 0;
            $returnResponse['code'] = $e->getCode();
            $returnResponse['msg'] = 'There is some error Please try After some time';
        }
        return $returnResponse;
    }

    public function listing($limit = 25, $active = true, $fields = array(), $filters = array(), $sort = 'name', $with = 'city') {
        $query = $this::newQuery();
        if (!$fields)
            $fields = array($this->table . '.*');

        if ($active)
            $query->where($this->table . '.is_active', '=', 1);

        if ($filters) {
            if (isset($filters['search']))
                $query->whereRaw("LOWER(name) LIKE '%" . strtolower($filters['search']) . "%' ");

            if (isset($filters['city_id']))
                $query->where($this->table . '.city_id', '=', $filters['city_id']);
        } // END: if ($filters) {
        try {
            return $query->with($with)->orderBy($sort, 'ASC')->paginate($limit, $fields);
        } catch (Exception $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }

    public function remove($id) {
        try {
            return $this->destroy($id);
        } catch (Exception $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
        return false;
    }

    public function enable($id) {
        try {
            return $this::where($id)->update(array('is_active', 1));
        } catch (Exception $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
        return false;
    }

    public function disable($id) {
        try {
            return $this::where($id)->update(array('is_active', 0));
        } catch (Exception $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
        return false;
    }

    public static function nav($id) {
        return $nav = array(
            array('key' => 'area', 'name' => 'Overview', 'url' => '/area/' . $id),
        );
    }

}
