<?php

namespace SmartCarBazar\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use \Exception as Exception;
use SmartCarBazar\Models\CommonAttributes;
use SmartCarBazar\Models\Seo;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Page extends CommonAttributes implements SluggableInterface {

    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
    ];
    ///protected $morphClass = 'vehicle';
    protected $table = 'common_attributes';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $fillable = ['name', 'parent_id', 'type', 'slug', 'description', 'is_active', 'created_by', 'updated_by'];
    public $timestamps = true;

    public function getIsActiveAttribute($val) {
        return ($val == 'active') ? 'Active' : 'Not active';
    }

    public function scopePage($query) {
        return $query->where('type', 'page');
    }
    public function scopeActive($query) {
        return $query->where('is_active', 1);
    }

    public function category() {
        return $this->belongsTo('SmartCarBazar\Models\Category');
    }

    public function parent() {
    return $this->belongsTo('SmartCarBazar\Models\Page', 'parent_id');


    }

public function photos() {
    return $this->morphMany('SmartCarBazar\Models\Photo', 'imageable');
}

public function seo() {
    return $this->morphOne('SmartCarBazar\Models\Seo', 'seoable');
}

public function add($data, $corporate_id = 0) {
    $returnResponse = ['status' => 1, 'code' => null, 'msg' => null];
    try {
        if (empty($data['parent_id']) || '' == $data['parent_id'])
            unset($data['parent_id']);
        $data['type'] = 'page';
        $seo['title'] = $data['meta_title'];
        $seo['keyword'] = $data['meta_keywords'];
        $seo['description'] = $data['meta_description'];
        unset($data['meta_title']);
        unset($data['meta_keywords']);
        unset($data['meta_description']);
        $page = self::create($data);

        if ($page)
            $page->seo()->create($seo);
        //dd(\DB::getQueryLog());
        if ($page) {
            $returnResponse['status'] = 1;
            $returnResponse['id'] = $page;
        } else {
            $returnResponse['status'] = 0;
        }
    } catch (\Illuminate\Database\QueryException $e) {
        $errorCode = $e->errorInfo[1];
        if ($errorCode == 1062) {
            // houston, we have a duplicate entry problem
            $returnResponse['status'] = 0;
            $returnResponse['code'] = 1062;
            $returnResponse['msg'] = 'Please enter a unique page name';
        }
    } catch (\Exception $e) {
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
    $page = $this::find($id);
    $returnResponse = ['status' => 1, 'code' => null, 'msg' => null];
    try {
        if (empty($data['parent_id']) || '' == $data['parent_id'])
            unset($data['parent_id']);
        $seo['title'] = $data['meta_title'];
        $seo['keyword'] = $data['meta_keywords'];
        $seo['description'] = $data['meta_description'];
        unset($data['meta_title']);
        unset($data['meta_keywords']);
        unset($data['meta_description']);
        $res = $page->update($data);
        if ($page->seo()->count())
            $page->seo()->update($seo);
        if ($page) {
            $returnResponse['status'] = 1;
            $returnResponse['id'] = $page;
        } else {
            $returnResponse['status'] = 0;
        }
    } catch (\Illuminate\Database\QueryException $e) {
        $errorCode = $e->errorInfo[1];
        if ($errorCode == 1062) {
            // houston, we have a duplicate entry problem
            $returnResponse['status'] = 0;
            $returnResponse['code'] = 1062;
            $returnResponse['msg'] = 'Please enter a unique page name';
        }
    } catch (\Exception $e) {
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

public function ajaxListing($params) {
    $length = $params['length'] ? $params['length'] : 10;
    $length = $params['length'] ? $params['length'] : 10;
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

public function getPageBySlug($slug) {

    try {
        return $this::where('slug', $slug)->page()->active()->get();
    } catch (Exception $e) {
        //$this->validations->add('error', Lang::get('messages.crud.failed', array('action' => 'Read')));
        throw new Exception($e->getMessage(), $e->getCode(), $e->getPrevious());
    }
    return null;
}

}
