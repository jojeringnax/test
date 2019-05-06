<?php
/**
 * Created by PhpStorm.
 * User: jojer
 * Date: 2019-05-03
 * Time: 23:23
 */
namespace jojer\other;

/**
 * Class Paginator
 * @package jojer\other
 */
class Paginator
{
    /**
     * @var array
     */
    private $array;

    /**
     * @var float
     */
    private $pages;

    /**
     * @var string
     */
    private $bootstrapHtml;

    /**
     * @var string
     */
    private $movableSectionHTML='';

    /**
     * @var string
     */
    private $pagesNumbersHTML;

    /**
     * Paginator constructor.
     * @param $array
     * @param int $limit
     */
    public function __construct($array, $limit=3)
    {
        $this->array = $array;
        $this->pages = ceil(count($array)/$limit);
        if ($this->pages < 2) {
            return null;
        }
        $this->bootstrapHtml = '<table class="table">
    <thead>
    <tr>
        <th scope="col" style="width: 10%">#</th>
        <th scope="col" style="width: 30%">Content</th>
        <th scope="col" style="width: 15%">Email</th>
        <th scope="col" style="width: 15%">Username</th>
        <th scope="col" style="width: 30%">Actions</th>
    </tr>
    </thead>
    <tbody>';
        $this->pagesNumbersHTML = '<ul class="pagination">';
        $this->pagesNumbersHTML .= '<li class="page-item"><a class="prev page-link" href="#">Previous</a></li>';
        $index = 0;
        for ($i=1;$i<=$this->pages;$i++) {
            $this->movableSectionHTML .= '<table class="table movable'.($i !== 1 ? ' hidden' : '').'"  data-id="'.$i.'"><tbody>';
            for ($j=0;$j<$limit;$j++) {
                if ($index >= count($array)) {
                    break;
                }
                $this->movableSectionHTML .= '<tr class="'.($array[$index]->status ? 'bg-danger' : 'bg-success').'">';
                $this->movableSectionHTML .= '<td style="width: 10%">'.$array[$index]->id.'</td>';
                $this->movableSectionHTML .= '<td style="width: 30%">'.$array[$index]->content.'</td>';
                $this->movableSectionHTML .= '<td style="width: 15%">'.$array[$index]->email.'</td>';
                $this->movableSectionHTML .= '<td style="width: 15%">'.$array[$index]->username.'</td>';
                $this->movableSectionHTML .= '<td style="width: 30%">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <a href="/task/show?id='.$array[$index]->id.'">Show</a>
                                                        </div>
                                                        <div class="col-4">
                                                            <a href="/task/edit?id='.$array[$index]->id.'">Edit</a>
                                                        </div>
                                                        <div class="col-4">
                                                            <a href="/task/delete?id='.$array[$index]->id.'">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>';
                $this->movableSectionHTML .= '</tr>';
                $index++;
            }
            $this->movableSectionHTML .= '</tbody></table>';
            $this->pagesNumbersHTML .= '<li class="page-item"><a class="page-link'.($i === 1 ? ' active' : '').'" data-id="'.$i.'" href="#">'.$i.'</a></li>';
        }
        $this->pagesNumbersHTML .= '<li class="page-item"><a class="next page-link" href="#">Next</a></li>';
        $this->pagesNumbersHTML .= '</ul>';
        $this->bootstrapHtml .= $this->movableSectionHTML;
        $this->bootstrapHtml .= '</tbody></table>';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->bootstrapHtml.$this->pagesNumbersHTML;
    }


}