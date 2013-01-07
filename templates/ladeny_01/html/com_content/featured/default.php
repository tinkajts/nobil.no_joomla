<?php
defined('_JEXEC') or die;

require_once dirname(__FILE__) . str_replace('/', DIRECTORY_SEPARATOR, '/../../../functions.php');

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers'); 

$view = new ArtxContent($this, $this->params);

echo $view->beginPageContainer('blog-featured');
if (strlen($view->pageHeading))
    echo $view->pageHeading();

$leadingcount = 0;
if (!empty($this->lead_items)) {
	echo '<!-- lead_items start -->';
	echo '<div class="items-leading">';
    foreach ($this->lead_items as $item) {
        echo '<div class="leading-' . $leadingcount . ($item->state == 0 ? ' system-unpublished' : '') . '">';
        $this->item = $item;
        echo $this->loadTemplate('item');
        echo '</div>';
        $leadingcount++;
    }
    echo '</div>';
    echo '<!-- lead_items end -->';
}

$introcount = count($this->intro_items);
$counter = 0;
if (!empty($this->intro_items)) {
    foreach ($this->intro_items as $key => $item) {
        $key = ($key - $leadingcount) + 1;
        $rowcount = (((int)$key - 1) % (int)$this->columns) + 1;
        $row = $counter / $this->columns;
        if ($rowcount == 1){
        	echo '<!-- intro_items start rowcount=1 -->';
        	echo '<div class="items-row cols-' . (int) $this->columns . ' row-' . $row . '">';
        	echo '<!-- intro_items start -->';
        }
        echo '<!-- intro_item start-->';
        echo '<div class="item column-' . $rowcount . ($item->state == 0 ? ' system-unpublished"' : '') . '">';
        $this->item = $item;
        echo $this->loadTemplate('item');
        echo '</div>';
        echo '<!-- intro_item end-->';
        $counter++;
        if ($rowcount == $this->columns || $counter == $introcount){
        	echo '<!-- separator start-->';
        	echo '<span class="row-separator"></span></div>';
        	echo '<!-- separator end-->';
        }
        if ($rowcount == 1){
        	echo '</div>';
        	echo '<!-- intro_items end rowcount=1 -->';
        }
    }
}

if (!empty($this->link_items)) {
    ob_start();
    echo '<div class="items-more">' . $this->loadTemplate('links') . '</div>';
    echo artxPost(ob_get_clean());
}

if ($this->params->def('show_pagination', 2) == 1
    || ($this->params->get('show_pagination') == 2
        && $this->pagination->get('pages.total') > 1))
{
    ob_start();
    echo '<div class="pagination">';
    if ($this->params->def('show_pagination_results', 1))
        echo '<p class="counter">' . $this->pagination->getPagesCounter() . '</p>';
    echo $this->pagination->getPagesLinks();
    echo '</div>';
    echo artxPost(ob_get_clean());
}
echo $view->endPageContainer();
