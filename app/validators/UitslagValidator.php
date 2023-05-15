<?php

   class UitslagValidator
  {
        public static function validateUitslagInputFields($data) : PromiseEntity
        {        
            try
            {
                $promiseObj = new PromiseEntity();

                $promiseObj->Isvalid = false;
                $promiseObj->Message = '';

                if (empty($data['Aantalpunten'])) 
                {
                    $promiseObj->Message = 'Voer aantalpunten in';
                }
                elseif(!is_numeric($data['Aantalpunten']))
                {
                    $promiseObj->Message = 'aantalpunten is onjuiste integer formaat';
                }  
                elseif($data['Aantalpunten'] > 300)
                {
                    $promiseObj->Message = 'aantalpunten is te groot!';
                }
                elseif($data['Aantalpunten'] <= 0)
                {
                    $promiseObj->Message = 'aantalpunten is te kort!';
                }

                $isAantalpuntenErrorEmpty = empty("$promiseObj->Message");

                if ($isAantalpuntenErrorEmpty)
                {
                    $promiseObj->Isvalid = true;
                } 

                return $promiseObj;
            }
            catch(Exception $ex)
            {
                error_log("Failed to valide selected Sollicitatie in class SollicitatieValidator->validatSollicitatieInputFields!", 0);
            }
          }
    }
?>