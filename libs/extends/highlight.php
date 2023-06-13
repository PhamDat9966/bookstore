<?php
class Highlighter
{
    private $_text;
    private $_keywords;
    
    private $keywords;
    private $text;
    
    private $tag = "b";
    
    public function highlight($text, $keywords)
    {
        $this->text = $text;
        $this->keywords = (array) $keywords;
        
        if(count($keywords) > 0)
        {
            $this->prepareString();
            $this->highlightStrings();
        }
        
        return $this->text;
    }
    
    private function unicodeSymbols()
    {
        return [
            'à' => 'a',
            'á' => 'a',
            'ả' => 'a',
            'ã' => 'a',
            'ạ' => 'a',
            
            'ă' => 'a',
            'ằ' => 'a',
            'ắ' => 'a',
            'ẳ' => 'a',
            'ẵ' => 'a',
            'ặ' => 'a',
            
            'â' => 'a',
            'ậ' => 'a',
            'ầ' => 'a',
            'ấ' => 'a',
            'ẩ' => 'a',
            'ẫ' => 'a',
            
            'o' => 'o',
            'ó' => 'o',
            'ò' => 'o',
            'ỏ' => 'o',
            'õ' => 'o',
            'ọ' => 'o',
            
            'ô' => 'o',
            'ố' => 'o',
            'ồ' => 'o',
            'ổ' => 'o',
            'ỗ' => 'o',
            'ộ' => 'o',
            
            'ơ' => 'o',
            'ớ' => 'o',
            'ờ' => 'o',
            'ở' => 'o',
            'ỡ' => 'o',
            'ợ' => 'o',
            
            'é' => 'e',
            'è' => 'e',
            'ẻ' => 'e',
            'ẽ' => 'e',
            'ẹ' => 'e',
            
            'ê' => 'e',
            'ế' => 'e',
            'ề' => 'e',
            'ể' => 'e',
            'ễ' => 'e',
            'ệ' => 'e',
            
            'ú' => 'u',
            'ù' => 'u',
            'ủ' => 'u',
            'ũ' => 'u',
            'ụ' => 'u',
            
            'í' => 'i',
            'ì' => 'i',
            'ỉ' => 'i',
            'ĩ' => 'i',
            'ị' => 'i',
            
            'ư' => 'u',
            'ứ' => 'u',
            'ừ' => 'u',
            'ử' => 'u',
            'ữ' => 'u',
            'ự' => 'u',
            
            'ý' => 'y',
            'ỳ' => 'y',
            'ỷ' => 'y',
            'ỹ' => 'y',
            'ỵ' => 'y',
            
        ];
    }
    
    private function clearVars()
    {
        $this->_text = null;
        $this->_keywords = [];
    }
    
    private function prepareString()
    {
        $this->clearVars();
        
        $this->_text = strtolower( strtr($this->text, $this->unicodeSymbols()) );
        
        foreach ($this->keywords as $keyword)
        {
            $this->_keywords[] = strtolower( strtr($keyword, $this->unicodeSymbols()) );
        }
    }
    
    private function highlightStrings()
    {
        foreach ($this->_keywords as $keyword)
        {
            
            if(strlen($keyword) === 0) continue;
            
            // find cleared keyword in cleared text.
            $pos = strpos($this->_text, $keyword);
            
            if($pos !== false)
            {
                
                $keywordLength = strlen($keyword);
                
                // find original keyword.
                $originalKeyword = mb_substr($this->text, $pos, $keywordLength);
                
                // highlight in both texts.
                $this->text = str_replace($originalKeyword, "<{$this->tag}>".$originalKeyword."</{$this->tag}>", $this->text);
                $this->_text = str_replace($keyword, "<{$this->tag}>".$keyword."</{$this->tag}>", $this->_text);
            }
            
        }
    }
    
    public function setTag($tag)
    {
        $this->tag = $tag;
    }
}