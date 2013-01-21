<?php

/*
 * This file is part of the Pagerfanta package.
 *
 * (c) Pablo Díez <pablodip@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IHQS\ForumBundle\View;

use Pagerfanta\PagerfantaInterface;
use Pagerfanta\View\ViewInterface;

class SemanticView implements ViewInterface
{
    /**
     * {@inheritdoc}
     */
    public function render(PagerfantaInterface $pagerfanta, $routeGenerator, array $options = array())
    {
        $options = array_merge(array(
            'proximity'          => 3,
            'previous_message'   => 'Previous',
            'next_message'       => 'Next',
            'css_disabled_class' => 'disabled',
            'css_dots_class'     => 'dots',
            'css_current_class'  => 'current',
        ), $options);

        $currentPage = $pagerfanta->getCurrentPage();

        $startPage = $currentPage - $options['proximity'];
        $endPage = $currentPage + $options['proximity'];

        if ($startPage < 1) {
            $endPage = min($endPage + (1 - $startPage), $pagerfanta->getNbPages());
            $startPage = 1;
        }
        if ($endPage > $pagerfanta->getNbPages()) {
            $startPage = max($startPage - ($endPage - $pagerfanta->getNbPages()), 1);
            $endPage = $pagerfanta->getNbPages();
        }

        $pages = array();

		// previous
		$previous = $pagerfanta->hasPreviousPage()
			? '<a href=" ' . $routeGenerator($pagerfanta->getPreviousPage()) . ' ">&laquo; Previous</a>'
			: '<span>&laquo; Previous</span>';

		// next
		$next = $pagerfanta->hasNextPage()
			? '<a href=" ' . $routeGenerator($pagerfanta->getNextPage()) . ' ">Next &raquo;</a>'
			: '<span>Next &raquo;</span>';

        // pages
        for ($page = $startPage; $page <= $endPage; $page++) {
            if ($page == $currentPage) {
                $pages[] = '<span class="page current">' . $page . '</span>';
            } else {
                $pages[] = '<strong><a class="page" href="' . $routeGenerator($page)  . '">' . $page . '</a></strong>';
            }
        }

        return '
			<div class="pagination">

				<p class="previous">
					' . $previous . '
				</p>

				<ul class="pages">
					<li> ' . implode('</li><li>', $pages) . '</li>
				</ul>

				<p class="next">
					' . $next . '
				</p>

			</div>
		';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ihqsforum';
    }
}