<?php

namespace PN\Foundation\Presenters;


trait PresenterTrait
{
    private $presenter;

    public function presenter()
    {
        if ($this->presenter != null) {
            return $this->presenter;
        }

        $model = get_class($this);

        $presenter = $model . 'Presenter';

        if (class_exists($presenter)) {
            $this->presenter = new $presenter($this);

            return $this->presenter;
        }

        throw new PresenterDoesNotExistException($presenter);
    }
//
//    public function __call($name, $arguments)
//    {
//        if(method_exists($this, $name)){
//            return call_user_func_array([$this, $name], $arguments);
//        } else if(method_exists($this->getPresenter(), $name)){
//            return call_user_func_array([$this->getPresenter(), $name], $arguments);
//        } else {
//            return parent::__call($name, $arguments);
//        }
//    }
//
//    public function __get($name)
//    {
//        if(method_exists($this->getPresenter(), $name)){
//            return $this->getPresenter()->$name();
//        } else {
//            return parent::__get($name);
//        }
//    }
}
