<?php
	// Hans Anderson's xmlize() mirrored here: http://github.com/rmccue/XMLize. It made sense at the time.
	function xmlize($data, $WHITE=1, $encoding='UTF-8') {
    $data = trim($data);
    $vals = $index = $array = array();
    $parser = xml_parser_create($encoding);
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, $WHITE);
    xml_parse_into_struct($parser, $data, $vals, $index);
    xml_parser_free($parser);
    $i = 0;
    $tagname = $vals[$i]['tag'];
    if ( isset ($vals[$i]['attributes'] ) )
    {
        $array[$tagname]['@'] = $vals[$i]['attributes'];
    } else {
        $array[$tagname]['@'] = array();
    }
    $array[$tagname]["#"] = xml_depth($vals, $i);
	return $array;
}

function xml_depth($vals, &$i) {
    $children = array();
    if ( isset($vals[$i]['value']) )
    {
        array_push($children, $vals[$i]['value']);
    }
    while (++$i < count($vals)) {
        switch ($vals[$i]['type']) {
           case 'open':
                if ( isset ( $vals[$i]['tag'] ) )
                {
                    $tagname = $vals[$i]['tag'];
                } else {
                    $tagname = '';
                }
                if ( isset ( $children[$tagname] ) )
                {
                    $size = sizeof($children[$tagname]);
                } else {
                    $size = 0;
                }
                if ( isset ( $vals[$i]['attributes'] ) ) {
                    $children[$tagname][$size]['@'] = $vals[$i]["attributes"];

                }
                $children[$tagname][$size]['#'] = xml_depth($vals, $i);
            break;
            case 'cdata':
                array_push($children, $vals[$i]['value']);
            break;
            case 'complete':
                $tagname = $vals[$i]['tag'];
                if( isset ($children[$tagname]) )
                {
                    $size = sizeof($children[$tagname]);
                } else {
                    $size = 0;
                }
                if( isset ( $vals[$i]['value'] ) )
                {
                    $children[$tagname][$size]["#"] = $vals[$i]['value'];
                } else {
                    $children[$tagname][$size]["#"] = '';
                }
                if ( isset ($vals[$i]['attributes']) ) {
                    $children[$tagname][$size]['@']
                                             = $vals[$i]['attributes'];
                }
            break;
            case 'close':
                return $children;
            break;
        }
    }
        return $children;
}


function tinyurl($url){
$turl = "http://tinyurl.com/create.php?url=".urlencode($url);
$tch = curl_init();
curl_setopt($tch, CURLOPT_URL, $turl);
curl_setopt($tch, CURLOPT_HEADER, 0);
curl_setopt($tch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($tch, CURLOPT_TIMEOUT, 10);
$tdata = curl_exec($tch); 
curl_close($tch);
preg_match('/http:\/\/preview\.tinyurl\.com\/(.*)<\/b>/',$tdata,$matches);
return "http://tinyurl.com/".$matches[1];
}

function traverse_xmlize($array, $arrName = "array", $level = 0) {
    foreach($array as $key=>$val)
    {
        if ( is_array($val) )
        {
            traverse_xmlize($val, $arrName . "[" . $key . "]", $level + 1);
        } else {
            $GLOBALS['traverse_array'][] = '$' . $arrName . '[' . $key . '] = "' . $val . "\"\n";
        }
    }
    return 1;
}
?>