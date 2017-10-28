<?php

$fullResults = [];
$fullResults = $this->getScheduleFull($esResult);

foreach ($fullResults as $fullResult) {
    $fullResult['bg_color'] = $colors['bg'];
    $fullResult['text_color'] = $colors['text'];
    
    $fullResult['description'] =  isset($fullResult['description'])?$fullResult['description']:null;
    $fullResult['attachments'] =  isset($fullResult['attachments'])?$fullResult['attachments']:[];
    $fullResult['recurrence'] =  isset($fullResult['recurrence'])?$fullResult['recurrence']:null;
    $fullResult['visibility'] =  isset($fullResult['visibility'])?$fullResult['visibility']:null;
    $fullResult['transparency'] =  isset($fullResult['transparency'])?$fullResult['transparency']:null;
    $fullResult['schedule_type'] =  isset($fullResult['schedule_type'])?$fullResult['schedule_type']:null;
    $fullResult['project'] =  isset($fullResult['project'])?$fullResult['project']:null;
    $fullResult['tags'] =  isset($fullResult['tags'])?$fullResult['tags']:null;
    $ret[] = $fullResult;
}
?>
