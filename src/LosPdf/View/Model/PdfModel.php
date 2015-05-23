<?php
/**
 * Pdf Model file
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosPdf
 * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosPdf
 */
namespace LosPdf\View\Model;

use Zend\View\Model\ViewModel;

/**
 * Pdf Model class
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosPdf
 * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosPdf
 */
class PdfModel extends ViewModel
{
    const PAPER_SIZE = 'paperSize';
    const PAPER_ORIENTATION = 'paperOrientation';
    const BASE_PATH = 'basePath';
    const FILE_NAME = 'fileName';

    const SIZE_A4 = 'A4';
    const SIZE_LETTER = 'Letter';

    const ORIENTATION_PORTRAIT = 'portrait';
    const ORIENTATION_LANDSCAPE = 'landscape';

    protected $options = [
        self::PAPER_SIZE => self::SIZE_A4,
        self::PAPER_ORIENTATION => self::ORIENTATION_PORTRAIT,
        self::BASE_PATH => '/',
        self::FILE_NAME => 'file',
    ];

    protected $captureTo = null;

    protected $terminate = true;
}
