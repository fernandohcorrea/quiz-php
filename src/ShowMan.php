<?php

namespace Quiz;

/**
 * Description of ShowMan
 *
 * @author fcorrea
 */
final class ShowMan {
    
    private $bootstrap = NULL;
    
    public function __construct() {
        $this->bootstrap = \Quiz\Bootstrap::getInstance();
    }
    
    public function getRandonQuestions($limit = NULL)
    {
        $dataQuestions = $this->loadDataQuestions();
        $questions_keys = array_keys($dataQuestions);
        shuffle($questions_keys);
        $limit = (is_int($limit)) ? $limit : count($dataQuestions);
        $returnData = array(
            'order' => array(),
            'questions' => array()
        );
        $count = 0;
        
        while( $count < $limit ){
            $idx = $questions_keys[$count];
            $returnData['order'][$count] = $idx;
            $returnData['questions'][$idx] = $this->hydrateQuestion($dataQuestions[$idx]);
            $count ++;
        }
        return $returnData;
    }
    
    private function loadDataQuestions()
    {
        $questions_dir = $this->bootstrap->getConfig('questions_dir');
        $questions_file_name = $this->bootstrap->getConfig('questions_file_name' , false);
        $questions_file_name = ($questions_file_name) ? $questions_file_name: 'questions'; 
        
        $questions_real_file = sprintf('%s'.DIRECTORY_SEPARATOR.'%s.%s', $questions_dir, $questions_file_name, 'php');
        
        if(!is_file($questions_real_file)){
            $exMessage = sprintf('Invalid questions file[%s]', $questions_file_name);
            throw new \RuntimeException($exMessage, 500);
        }
        
        return require $questions_real_file;
    }
    
    private function hydrateQuestion($question_array = array())
    {
        $question =  new \Quiz\Question();
        $question->hydrate($question_array);
        return $question;
    }
}
