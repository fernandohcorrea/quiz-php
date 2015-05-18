<?php

namespace Quiz;

/**
 * Description of QuestionBase
 *
 * @author fcorrea
 */
abstract class QuestionBase
{

    protected $question;
    protected $fileCodeSample;
    protected $multipleChoices;
    protected $answer;

    function getQuestion() {
        return $this->question;
    }

    function getFileCodeSample() {
        return $this->fileCodeSample;
    }
    
    function getMultipleChoices() {
        return $this->multipleChoices;
    }

    function getAnswer() {
        return $this->answer;
    }

    function setQuestion($question) {
        $this->question = $question;
    }

    function setMultipleChoices($multipleChoices) {
        $this->multipleChoices = $multipleChoices;
    }

    function setAnswer($answer) {
        $this->answer = (is_array($answer)) ? $answer : array( $answer );
    }

    public function setFileCodeSample($fileCodeSample)
    {
        if(!is_file($fileCodeSample)){
            throw new \InvalidArgumentException('File code sample is invalid', 500);
        } else {
            $this->fileCodeSample = $fileCodeSample;
            return $this;
        }
    }
    
    public function getHighlightCodeSample()
    {
        $highlight_file = NULL;
        if($this->getFileCodeSample()){
            $highlight_file = highlight_file($this->getFileCodeSample(), TRUE);
        }
        return $highlight_file;
    }
    
    public function hydrate( array $question_array )
    {
        if(!count($question_array)){
            throw new \InvalidArgumentException('Invalid array data', 500);
        }
        
        foreach ($question_array as $key => $value) {
            $myKeyPices = explode('_', strtolower($key));
            $myKeyParsed = array_map('ucfirst', $myKeyPices);
            $methodKey = 'set' . implode('', $myKeyParsed);
            $reflection = new \ReflectionObject($this);

            if(!$reflection->hasMethod($methodKey)){
                $exMsg = sprintf('Method[%s::%s]  Not Found', get_class($this), $methodKey);
                throw new \RuntimeException($exMsg, 500);
            }
            $this->$methodKey($value);
        }
        return $this;

    }
}
