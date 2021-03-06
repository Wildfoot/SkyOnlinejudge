<?php namespace SKYOJ\Contest;

if (!defined('IN_SKYOJSYSTEM')) {
    exit('Access denied');
}

function contest_api_bangkok_results_finalHandle()
{
    global $_G,$_E;
    try{
        if( !\userControl::isAdmin($_G['uid']) )
        {
            \SKYOJ\throwjson('error', 'Access denied');
        }

        $cont_id  = \SKYOJ\safe_get_int('cont_id');
        $contest = GetContestByID($cont_id);

        if( $contest->ispreparing() )
            throw new \Exception('Contest is preparing!');
        
        $json = $contest->get_resolver_all();

        echo $json;
        exit(0);
        \SKYOJ\throwjson('SUCC',$json);
    }catch(\Exception $e){
        \SKYOJ\throwjson('error',$e->getMessage());
    }
}