<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class StreamController extends Controller
{
    private $api_url = 'http://xnuitblanchegamingx.api.channel.livestream.com/2.0/';
    private $status = null;
    
    private function request($method, array $args = array(), $format = "json")
    {
        $uri = $this->api_url . $method . "." . $format;
        if(count($args) > 0)
        {
            $uri.= '?';
            foreach($args as $k => $v)
            {
                $uri.= $k . '=' . $v;
                $uri.= '&';
            }
        }

		try
		{
			$content = file_get_contents($uri);
			$data = json_decode($content);
			return $data;
		} 
		catch(\Exception $e)
		{
			return array();
		}
    }

    /**
     * @Template()
     */
    public function _statusAction()
    {
        if(is_null($this->status))
        {
            $data = $this->request('info');
            $status = ($data->channel->isLive) ? 'live' : 'off';
        }
		
        return array(
            'live'  => $status,
        );
    }

    /**
     * @Route("stream/list", name="stream_list")
     * @Template()
     */
    public function listAction()
    {
        $data   = $this->request('listclips', array('id' => '05dd1660-4798-40ea-8242-b7cc9feb244e'));
        $clips  =  $data->channel->item;
        
        foreach($clips as $i => $clip)
        {
            $clips[$i]->pubDate = new \Datetime($clip->pubDate);
            $clips[$i]->content->duration = $this->getNormalizedLength($clip->content->{"@duration"});
            $clips[$i]->thumbnail->url = $clip->thumbnail->{"@url"};
        }
        return array(
            'clips'  => $clips
        );
    }
    
    /**
     * @Route("stream/{clip_id}/watch", name="stream_watch")
     * @Template()
     */
    public function watchAction($clip_id)
    {
        return array(
            'clip_id'  => $clip_id
        );
    }

    /**
     * @Route("stream/live", name="stream_live")
     * @Template()
     */
    public function liveAction()
    {
        return array();
    }

    protected function getNormalizedLength($secs) {

        $mins	= floor($secs / 60);
        $secs	= $secs % 60;

        $values = array();
        if ($mins > 0)	{ $values[] = $mins . ' mins'; }
        $values[] = $secs . ' secs';

        return implode(', ', $values);
    }

}