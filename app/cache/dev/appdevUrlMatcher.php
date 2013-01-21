<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appdevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appdevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        // _wdt
        if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::toolbarAction',)), array('_route' => '_wdt'));
        }

        if (0 === strpos($pathinfo, '/_profiler')) {
            // _profiler_search
            if ($pathinfo === '/_profiler/search') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchAction',  '_route' => '_profiler_search',);
            }

            // _profiler_purge
            if ($pathinfo === '/_profiler/purge') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::purgeAction',  '_route' => '_profiler_purge',);
            }

            // _profiler_info
            if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::infoAction',)), array('_route' => '_profiler_info'));
            }

            // _profiler_import
            if ($pathinfo === '/_profiler/import') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::importAction',  '_route' => '_profiler_import',);
            }

            // _profiler_export
            if (0 === strpos($pathinfo, '/_profiler/export') && preg_match('#^/_profiler/export/(?P<token>[^/\\.]+)\\.txt$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::exportAction',)), array('_route' => '_profiler_export'));
            }

            // _profiler_phpinfo
            if ($pathinfo === '/_profiler/phpinfo') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::phpinfoAction',  '_route' => '_profiler_phpinfo',);
            }

            // _profiler_search_results
            if (preg_match('#^/_profiler/(?P<token>[^/]+)/search/results$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchResultsAction',)), array('_route' => '_profiler_search_results'));
            }

            // _profiler
            if (preg_match('#^/_profiler/(?P<token>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::panelAction',)), array('_route' => '_profiler'));
            }

            // _profiler_redirect
            if (rtrim($pathinfo, '/') === '/_profiler') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_profiler_redirect');
                }

                return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => '_profiler_search_results',  'token' => 'empty',  'ip' => '',  'url' => '',  'method' => '',  'limit' => '10',  '_route' => '_profiler_redirect',);
            }

        }

        if (0 === strpos($pathinfo, '/_configurator')) {
            // _configurator_home
            if (rtrim($pathinfo, '/') === '/_configurator') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_configurator_home');
                }

                return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
            }

            // _configurator_step
            if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',)), array('_route' => '_configurator_step'));
            }

            // _configurator_final
            if ($pathinfo === '/_configurator/final') {
                return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
            }

        }

        // homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'homepage');
            }

            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\MainController::indexAction',  '_route' => 'homepage',);
        }

        // lang
        if (0 === strpos($pathinfo, '/lang') && preg_match('#^/lang/(?P<lang>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\MainController::langAction',)), array('_route' => 'lang'));
        }

        // to_come
        if ($pathinfo === '/to_come') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\MainController::toComeAction',  '_route' => 'to_come',);
        }

        // exception
        if ($pathinfo === '/404') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\MainController::exceptionAction',  '_route' => 'exception',);
        }

        // league_show
        if (0 === strpos($pathinfo, '/league') && preg_match('#^/league/(?P<league_id>[^/]+)/show$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\LeagueController::showAction',)), array('_route' => 'league_show'));
        }

        // season_show
        if (0 === strpos($pathinfo, '/season') && preg_match('#^/season/(?P<season_id>[^/]+)/show$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\LeagueController::seasonShowAction',)), array('_route' => 'season_show'));
        }

        // league_list
        if ($pathinfo === '/league/list') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\LeagueController::listAction',  '_route' => 'league_list',);
        }

        // news_comment_edit
        if (0 === strpos($pathinfo, '/news/comment') && preg_match('#^/news/comment/(?P<id>[^/]+)/edit$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\NewsController::commentEditAction',)), array('_route' => 'news_comment_edit'));
        }

        // news_comment_delete
        if (0 === strpos($pathinfo, '/news/comment') && preg_match('#^/news/comment/(?P<id>[^/]+)/delete$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\NewsController::commentDeleteAction',)), array('_route' => 'news_comment_delete'));
        }

        // news_archives
        if ($pathinfo === '/news/archives') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\NewsController::archivesAction',  '_route' => 'news_archives',);
        }

        // news_show
        if (0 === strpos($pathinfo, '/news') && preg_match('#^/news/(?P<news_id>[^/]+)/show$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\NewsController::showAction',)), array('_route' => 'news_show'));
        }

        // contribute_news_new
        if ($pathinfo === '/contribute/news/add') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\NewsController::newAction',  '_route' => 'contribute_news_new',);
        }

        // contribute_news_edit
        if (0 === strpos($pathinfo, '/contribute/news') && preg_match('#^/contribute/news/(?P<news_id>[^/]+)/edit$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\NewsController::newAction',)), array('_route' => 'contribute_news_edit'));
        }

        // player_show
        if (0 === strpos($pathinfo, '/player') && preg_match('#^/player/(?P<user_id>[^/]+)/show$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\PlayerController::showAction',)), array('_route' => 'player_show'));
        }

        // player_show_profile
        if (0 === strpos($pathinfo, '/player') && preg_match('#^/player/(?P<user_id>[^/]+)/show/(?P<profile>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\PlayerController::showAction',)), array('_route' => 'player_show_profile'));
        }

        // player_list
        if ($pathinfo === '/users') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\PlayerController::listAction',  '_route' => 'player_list',);
        }

        // replay_show
        if (0 === strpos($pathinfo, '/replay') && preg_match('#^/replay/(?P<replay_id>[^/]+)/show$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\ReplayController::showAction',)), array('_route' => 'replay_show'));
        }

        // replay_list
        if ($pathinfo === '/replay/list') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\ReplayController::listAction',  '_route' => 'replay_list',);
        }

        // replay_file_download
        if (0 === strpos($pathinfo, '/replay') && preg_match('#^/replay/(?P<replay_id>[^/]+)/download$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\ReplayController::fileDownloadAction',)), array('_route' => 'replay_file_download'));
        }

        // contribute_replay_new
        if ($pathinfo === '/contribute/replay/add') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\ReplayController::newAction',  '_route' => 'contribute_replay_new',);
        }

        // stream_list
        if ($pathinfo === '/stream/list') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\StreamController::listAction',  '_route' => 'stream_list',);
        }

        // stream_watch
        if (0 === strpos($pathinfo, '/stream') && preg_match('#^/stream/(?P<clip_id>[^/]+)/watch$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\StreamController::watchAction',)), array('_route' => 'stream_watch'));
        }

        // stream_live
        if ($pathinfo === '/stream/live') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\StreamController::liveAction',  '_route' => 'stream_live',);
        }

        // team_show
        if (0 === strpos($pathinfo, '/team') && preg_match('#^/team/(?P<team_id>[^/]+)/show$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\TeamController::showAction',)), array('_route' => 'team_show'));
        }

        // team_list
        if ($pathinfo === '/team/list') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\TeamController::listAction',  '_route' => 'team_list',);
        }

        // war_show
        if (0 === strpos($pathinfo, '/war') && preg_match('#^/war/(?P<war_id>[^/]+)/show$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\WarController::showAction',)), array('_route' => 'war_show'));
        }

        // war_list
        if ($pathinfo === '/war/list') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\WarController::listAction',  '_route' => 'war_list',);
        }

        // contribute_war_new
        if ($pathinfo === '/contribute/war/add') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\WarController::newAction',  '_route' => 'contribute_war_new',);
        }

        // contribute_war_edit
        if (0 === strpos($pathinfo, '/contribute/war') && preg_match('#^/contribute/war/(?P<war_id>[^/]+)/edit$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\WarController::newAction',)), array('_route' => 'contribute_war_edit'));
        }

        // contribute_war_game
        if (0 === strpos($pathinfo, '/contribute/war/games') && preg_match('#^/contribute/war/games/(?P<game_id>[^/]+)/edit$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\WarController::gameAction',)), array('_route' => 'contribute_war_game'));
        }

        // _secured_register
        if ($pathinfo === '/register') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\SecuredController::registerAction',  '_route' => '_secured_register',);
        }

        // _secured_profile_edition
        if ($pathinfo === '/profile/edit') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\SecuredController::profileEditionAction',  '_route' => '_secured_profile_edition',);
        }

        // _secured_profile_password
        if ($pathinfo === '/profile/password') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\SecuredController::profilePasswordAction',  '_route' => '_secured_profile_password',);
        }

        // _secured_login
        if ($pathinfo === '/login') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\SecuredController::_loginAction',  '_route' => '_secured_login',);
        }

        // _security_check
        if ($pathinfo === '/login_check') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\SecuredController::securityCheckAction',  '_route' => '_security_check',);
        }

        // _security_logout
        if ($pathinfo === '/logout') {
            return array (  '_controller' => 'IHQS\\NuitBlancheBundle\\Controller\\SecuredController::logoutAction',  '_route' => '_security_logout',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
