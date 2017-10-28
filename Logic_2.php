<?php

    public function getScheduleByResource($request, $resourceId, $colors, $eventId = null)
    {
        $ret = [];
        $esResult = [];
        $sort = ['start' => 'asc'];
        // グループメンバー予定取得時に前のメンバーのフル取得時のページが残ってしまうためここで初期化
        $this->tokenParams['page'] = 1;

        $this->setSearchQueryByRequest($request, $sort);
        $this->makeGetResourceParams($request, $resourceId, $sort, $eventId);
        $esResult = $this->search();

        if (!is_null($eventId) && count($esResult['data']) === 1) {
            // eventId指定の場合は1件のはずなので配列にせず返す
            $esResult['data'][0]['bg_color'] = $colors['bg'];
            $esResult['data'][0]['text_color'] = $colors['text'];
            return $esResult['data'][0];
        }
        
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

        return $ret;
    }
