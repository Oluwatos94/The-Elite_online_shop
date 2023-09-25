<?php

namespace TeldsShop\App;

class View extends \stdClass
{
    const VIEWS_TEMPLATES_HEAD_PHP = "/../Views/templates/head.php";
    const VIEWS_TEMPLATES_NAVIGATION_PHP = "/../Views/templates/navigation.php";
    const VIEWS_TEMPLATES_FOOTER_PHP = "/../Views/templates/footer.php";
    const VIEWS_TEMPLATES_BANNER_PHP = "/../Views/templates/banner.php";
    const VIEWS_TEMPLATES_BANNER_SMALL_PHP = "/../Views/templates/header.php";
    const VIEWS_TEMPLATES_CONTAINER_PHP = "/../Views/templates/container.php";
    CONST PROPERTY_NOT_FOUND_ALERT = '{{PROPERTY NOT FOUND!!!}}';
    private string $actionNameForViews;
    private string $classNameForViews;
    public static string $error_message = '';

    public function __get($name)
    {
        if(property_exists($this, $name)){
            return $this->{$name};
        } else {
            return self::PROPERTY_NOT_FOUND_ALERT;
        }
    }

    public function render(string $pathToView, array $dataRendering): string
    {
        $this->storeDataToRender($dataRendering);
        $fileNameWithFullPath = __DIR__ . '/../Views/' . $this->classNameForViews . '/' . $pathToView . ".php";
        if(file_exists($fileNameWithFullPath)){
            $header = $this->getHeaderFile();
            $content = $this->getContentFile($fileNameWithFullPath);
            $header = $this->replacePlaceHolderWithContent($content, $header);
            $footer = $this->getFooterFile();
            return $header . $footer;
        }
        return "";

    }

    private function storeDataToRender(array $dataRendering): void
    {
        foreach($dataRendering as $key => $data){
            $this->{$key} = $data;
        }
    }

    public function getClassNameForViews(): string
    {
        return $this->classNameForViews;
    }
    public function setClassNameForViews(string $classNameForViews): void
    {
        $this->classNameForViews = $classNameForViews;
    }


    public function getActionNameForViews(): string
    {
        return $this->actionNameForViews;
    }
    public function setActionNameForViews(string $actionNameForViews): void
    {
        $this->actionNameForViews = $actionNameForViews;
    }

    private function getHeaderFile(): string|false
    {
        $data = $this;
        ob_start();
        require_once __DIR__ . self::VIEWS_TEMPLATES_HEAD_PHP;
        require_once __DIR__ . self::VIEWS_TEMPLATES_NAVIGATION_PHP;
        if ($this->showBanner === true) {
            require_once __DIR__ . self::VIEWS_TEMPLATES_BANNER_PHP;
        } else {
            require_once __DIR__ . self::VIEWS_TEMPLATES_BANNER_SMALL_PHP;
        }
        require_once self::VIEWS_TEMPLATES_CONTAINER_PHP;

        $header = ob_get_contents();
        ob_clean();
        return $header;
    }
    private function getFooterFile(): string|false
    {
        $data = $this;
        ob_start();
        require_once __DIR__ . self::VIEWS_TEMPLATES_FOOTER_PHP;
        $footer = ob_get_contents();
        ob_clean();
        return $footer;
    }
    private function getContentFile(string|false $fileNameWithCompletePath): string|false
    {
        $data = $this;
        ob_start();
        require_once $fileNameWithCompletePath;
        $content = ob_get_contents();
        ob_clean();
        return $content;
    }
    private function replacePlaceHolderWithContent(string|false $content, string|false $header): string|false|array
    {
        return str_replace(CONTENT_PLACE_HOLDER, $content, $header);
    }
}