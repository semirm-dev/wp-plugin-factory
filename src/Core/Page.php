<?php
namespace PluginFactory\Core;

class Page {
    private $title;

    private $menuTitle;

    private $capability;

    private $menuSlug;

    private $callback;

    private $iconURL;

    private $position;

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function setMenuTitle(string $menuTitle): void {
        $this->menuTitle = $menuTitle;
    }

    public function setCapability(string $capability): void {
        $this->capability = $capability;
    }

    public function setMenuSlug(string $menuSlug): void {
        $this->menuSlug = $menuSlug;
    }

    public function setCallback($callback): void {
        $this->callback = $callback;
    }

    public function setIconURL(string $iconURL): void {
        $this->iconURL = $iconURL;
    }

    public function setPosition(int $position): void {
        $this->position = $position;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getMenuTitle(): string {
        return $this->menuTitle;
    }

    public function getCapability(): string {
        return $this->capability;
    }

    public function getMenuSlug(): string {
        return $this->menuSlug;
    }

    public function getCallback() {
        return $this->callback;
    }

    public function getIconURL(): string {
        return $this->iconURL;
    }
    
    public function getPosition(): int {
        return $this->position;
    }
}