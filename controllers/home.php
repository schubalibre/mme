<?php
/* 
 * Project: ODDS & ENDS
 * File: /controllers/home.php
 * Purpose: controller for the home of the app.
 * Author: Robert Dziuba & Inga Schwarze
 */
 // HOME: KEIN BACKEND; die eigentliche Webseite
 // Control: Schnittstelle zwischen Model und View, bestimmt, welche Daten für welche View bestimmt sind
 // Design funktioniert mit den Daten, Control ist Brücke zwischen Daten und View.
 // Home-Controller: Bei mme.local/home wird dieser Controller aufgerufen
 // Jede dieser Methoden führt Model und View zusammen, wenn der User z.B. /home eingibt, wird indexAction aufgerufen
 // Link-Klick oder Ajax Request? 
 // Control bekommt Anfrage, sucht sich passend Model und View und gibt Daten aus Model an View zurück

class HomeController extends BaseController
{
    //add to the parent constructor
    public function __construct($action, $urlValues)
    {
        parent::__construct($action, $urlValues);

        //create the model object
        require("models/home.php");
        $this->model = new HomeModel();

        require("helpers/formValidator.php");
    }

    //default method
    protected function indexAction()
    {
        if($this->request->xmlhttprequest()){
            $this->view->ajaxRespon($this->model->index());
        }else{
            $this->view->output($this->model->index());
        }
    }

    public function roomAction() {
        $errors = null;

        if($this->request->httpMethod() === "GET") {

            /*** a new validation instance ***/
            $val = new FormValidator();

            /*** use POST as the source ***/
            $val->addSource($this->request->uriValues());

            /*** an array of rules ***/
            $rules_array = array(
                'id'=>array('type'=>'numeric', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true)
            );

            /*** add an array of rules ***/
            $val->addRules($rules_array);

            /*** run the validation rules ***/
            $val->run();

            /*** if there are errors show them ***/
            if(sizeof($val->errors) > 0) {
                $errors = $val->errors;
            }else{

                $data = $val->getSanitized();

                $this->view->ajaxRespon($this->model->getRoom($data->id));

            }
        }
    }

    public function articleAction() {
        $errors = null;

        if($this->request->httpMethod() === "GET") {

            /*** a new validation instance ***/
            $val = new FormValidator();

            /*** use POST as the source ***/
            $val->addSource($this->request->uriValues());

            /*** an array of rules ***/
            $rules_array = array(
                'id'=>array('type'=>'numeric', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true)
            );

            /*** add an array of rules ***/
            $val->addRules($rules_array);

            /*** run the validation rules ***/
            $val->run();

            /*** if there are errors show them ***/
            if(sizeof($val->errors) > 0) {
                $errors = $val->errors;
            }else{

                $data = $val->getSanitized();

                $this->view->ajaxRespon($this->model->getArticle($data->id));
            }
        }
    }

    public function contactAction(){
        if($this->request->xmlhttprequest()){
            $this->view->ajaxRespon($this->model->staticPage("Kontact"));
        }else{
            $this->view->output($this->model->staticPage("Kontact"));
        }
    }

    public function impressumAction(){
        if($this->request->xmlhttprequest()){
            $this->view->ajaxRespon($this->model->staticPage("Impressum"));
        }else{
            $this->view->output($this->model->staticPage("Impressum"));
        }
    }

    public function termsConditionsAction(){
        if($this->request->xmlhttprequest()){
            $this->view->ajaxRespon($this->model->staticPage("AGB"));
        }else{
            $this->view->output($this->model->staticPage("AGB"));
        }
    }

}

?>
