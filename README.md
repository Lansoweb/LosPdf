# LosPdf
[![Latest Stable Version](https://poser.pugx.org/los/lospdf/v/stable.svg)](https://packagist.org/packages/los/lospdf) [![Total Downloads](https://poser.pugx.org/los/lospdf/downloads.svg)](https://packagist.org/packages/los/lospdf) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Lansoweb/LosPdf/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Lansoweb/LosPdf/?branch=master) [![SensioLabs Insight](https://img.shields.io/sensiolabs/i/f375397a-bde1-4b52-80f7-91f351f0ae4c.svg?style=flat)](https://insight.sensiolabs.com/projects/f375397a-bde1-4b52-80f7-91f351f0ae4c) [![Dependency Status](https://www.versioneye.com/user/projects/54da836cc1bbbd5f82000357/badge.svg?style=flat)](https://www.versioneye.com/user/projects/54da836cc1bbbd5f82000357)

## Introduction

This ZF2 module provides a wrapper to [mPdf](http://www.mpdf1.com) (more coming) to generate PDF documents from html.

## Requirements
- [Zend Framework 2](http://framework.zend.com/)
- [mPdf](http://www.mpdf1.com)

## Instalation
Instalation can be done with composer ou manually

### Installation with composer
For composer documentation, please refer to [getcomposer.org](http://getcomposer.org/).

  1. Enter your project directory
  2. Create or edit your `composer.json` file with following contents:

     ```json
     {
         "require": {
             "los/lospdf": "1.*",
             "mpdf/mpdf" : ">=v5.7.4",
         }
     }
     ```
  3. Run `php composer.phar install`
  4. Open `my/project/directory/config/application.config.php` and add `LosPdf` to your `modules`
     
    ```php
    <?php
    return array(
        'modules' => array(
            'LosPdf',
            'Application'
        ),
        'module_listener_options' => array(
            'config_glob_paths'    => array(
                'config/autoload/{,*.}{global,local}.php',
            ),
            'module_paths' => array(
                './module',
                './vendor',
            ),
        ),
    );
    ```

### Installation without composer

  1. Clone this module [LosPdf](http://github.com/LansoWeb/LosPdf) to your vendor directory
  2. Enable it in your config/application.config.php like the step 4 in the previous section.

## Usage

### Render to browser

The following example demonstrates a typical usage of the LosPdf module inside an Action in a Controller:

```php
    public function pdfAction()
    {
        $generated = new \DateTime('now');
        $genetared = $gerado->format('d/m/Y H:i:s');

        $pdf = new PdfModel();
        $renderer = $this->getServiceLocator()->get('ViewPdfRenderer');
        $renderer->getEngine()->setHTMLHeader('<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic; border-bottom: 1px solid #000"><tr>
<td width="33%"><span style="font-weight: bold; font-style: italic;">Client</span></td>
<td width="33%" align="center" style="font-weight: bold; font-style: italic;">Report Name</td>
<td width="33%" style="text-align: right; ">My Company</td>
</tr></table>
');
        $renderer->getEngine()->setHTMLFooter('Footer', '<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic; border-top: 1px solid #000"><tr>
<td width="50%" style="text-align: left; font-weight: bold; font-style: italic;">Generated: '.$generated.'</td>
<td width="50%" style="text-align: right; ">Page {PAGENO}</td>
</tr></table>
');

        $pdf->setTerminal(true);
        $pdf->setVariables(['name'=>'Leandro']);
        $pdf->setOption("paperSize", "a4");

        return $pdf;
    }
```

And use the view file as usual.

You can set any mPdf option through $renderer->getEngine():
```php
$renderer = $this->getServiceLocator()->get('ViewPdfRenderer');
$renderer->getEngine()->pagenumPrefix = 'Page n ';
```

### Render to string

You can capture the pdf output to a string:

```php
    public function pdfAction()
    {
        $generated = new \DateTime('now');
        $genetared = $gerado->format('d/m/Y H:i:s');

        $pdf = new PdfModel();
        $renderer = $this->getServiceLocator()->get('ViewPdfRenderer');
        $renderer->getEngine()->setHTMLHeader('<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic; border-bottom: 1px solid #000"><tr>
<td width="33%"><span style="font-weight: bold; font-style: italic;">Client</span></td>
<td width="33%" align="center" style="font-weight: bold; font-style: italic;">Report Name</td>
<td width="33%" style="text-align: right; ">My Company</td>
</tr></table>
');
        $renderer->getEngine()->setHTMLFooter('Footer', '<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic; border-top: 1px solid #000"><tr>
<td width="50%" style="text-align: left; font-weight: bold; font-style: italic;">Generated: '.$generated.'</td>
<td width="50%" style="text-align: right; ">Page {PAGENO}</td>
</tr></table>
');

        $pdf->setTerminal(true);
        $pdf->setVariables(['name'=>'Leandro']);
        $pdf->setOption("paperSize", "a4");
        $pdf->setTemplate('site/index/pdf');
        $output = $renderer->renderToString($pdf);
        
        //Do something with output
    }
```

### Render to file

You can save the pdf to a file:

```php
    public function pdfAction()
    {
        $generated = new \DateTime('now');
        $genetared = $gerado->format('d/m/Y H:i:s');

        $pdf = new PdfModel();
        $renderer = $this->getServiceLocator()->get('ViewPdfRenderer');
        $renderer->getEngine()->setHTMLHeader('<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic; border-bottom: 1px solid #000"><tr>
<td width="33%"><span style="font-weight: bold; font-style: italic;">Client</span></td>
<td width="33%" align="center" style="font-weight: bold; font-style: italic;">Report Name</td>
<td width="33%" style="text-align: right; ">My Company</td>
</tr></table>
');
        $renderer->getEngine()->setHTMLFooter('Footer', '<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic; border-top: 1px solid #000"><tr>
<td width="50%" style="text-align: left; font-weight: bold; font-style: italic;">Generated: '.$generated.'</td>
<td width="50%" style="text-align: right; ">Page {PAGENO}</td>
</tr></table>
');

        $pdf->setTerminal(true);
        $pdf->setVariables(['name'=>'Leandro']);
        $pdf->setOption("paperSize", "a4");
        $pdf->setTemplate('site/index/pdf');
        $renderer->renderToFile($pdf, '/tmp/report.pdf');
    }
```

### Mixing outputs

You can use more than one render type. the following example will save the pdf to a file, render the pdf to a string and to the browser:

```php
    public function pdfAction()
    {
        $generated = new \DateTime('now');
        $genetared = $gerado->format('d/m/Y H:i:s');

        $pdf = new PdfModel();
        $renderer = $this->getServiceLocator()->get('ViewPdfRenderer');
        $renderer->getEngine()->setHTMLHeader('<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic; border-bottom: 1px solid #000"><tr>
<td width="33%"><span style="font-weight: bold; font-style: italic;">Client</span></td>
<td width="33%" align="center" style="font-weight: bold; font-style: italic;">Report Name</td>
<td width="33%" style="text-align: right; ">My Company</td>
</tr></table>
');
        $renderer->getEngine()->setHTMLFooter('Footer', '<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic; border-top: 1px solid #000"><tr>
<td width="50%" style="text-align: left; font-weight: bold; font-style: italic;">Generated: '.$generated.'</td>
<td width="50%" style="text-align: right; ">Page {PAGENO}</td>
</tr></table>
');

        $pdf->setTerminal(true);
        $pdf->setVariables(['name'=>'Leandro']);
        $pdf->setOption("paperSize", "a4");
        $pdf->setTemplate('site/index/pdf');
        $output = $renderer->renderToString($pdf);
        $renderer->renderToFile($pdf, '/tmp/report.pdf');
        
        return $pdf;
    }
```
