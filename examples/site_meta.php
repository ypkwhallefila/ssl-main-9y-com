<?php

/**
 * 站点元信息管理类
 *
 * 用于保存和展示站点的基础元信息，
 * 并提供生成简短描述文本的方法。
 */

class SiteMeta
{
    /**
     * 站点元数据数组
     *
     * @var array
     */
    private array $metaData;

    /**
     * 构造函数，初始化元信息
     */
    public function __construct()
    {
        $this->metaData = [
            'site_name'        => '九游娱乐中心',
            'site_url'         => 'https://ssl-main-9y.com',
            'site_description' => '九游官方平台，提供丰富的游戏资源和社区服务。',
            'site_keywords'    => ['九游', '游戏', '娱乐', '平台', '社区'],
            'author'           => '九游团队',
            'version'          => '1.0.0',
            'last_updated'     => '2025-04-01',
        ];
    }

    /**
     * 获取完整的元数据
     *
     * @return array
     */
    public function getMetaData(): array
    {
        return $this->metaData;
    }

    /**
     * 获取站点名称
     *
     * @return string
     */
    public function getSiteName(): string
    {
        return $this->metaData['site_name'];
    }

    /**
     * 获取站点 URL
     *
     * @return string
     */
    public function getSiteUrl(): string
    {
        return $this->metaData['site_url'];
    }

    /**
     * 获取站点关键词列表
     *
     * @return array
     */
    public function getKeywords(): array
    {
        return $this->metaData['site_keywords'];
    }

    /**
     * 生成简短描述文本
     *
     * 根据站点名称、描述和关键词生成一段简洁的介绍。
     *
     * @return string
     */
    public function generateShortDescription(): string
    {
        $name        = $this->metaData['site_name'];
        $description = $this->metaData['site_description'];
        $keywords    = implode('、', $this->metaData['site_keywords']);

        return "{$name} - {$description} 关键词：{$keywords}。";
    }

    /**
     * 生成用于 HTML 的 meta 标签字符串
     *
     * @return string
     */
    public function generateMetaTags(): string
    {
        $name        = htmlspecialchars($this->metaData['site_name'], ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($this->metaData['site_description'], ENT_QUOTES, 'UTF-8');
        $keywords    = htmlspecialchars(implode(', ', $this->metaData['site_keywords']), ENT_QUOTES, 'UTF-8');

        $tags  = '<meta name="description" content="' . $description . '" />' . PHP_EOL;
        $tags .= '<meta name="keywords" content="' . $keywords . '" />' . PHP_EOL;
        $tags .= '<meta name="author" content="' . $name . '" />';

        return $tags;
    }

    /**
     * 更新站点描述
     *
     * @param string $newDescription
     */
    public function updateDescription(string $newDescription): void
    {
        $this->metaData['site_description'] = $newDescription;
    }

    /**
     * 添加单个关键词
     *
     * @param string $keyword
     */
    public function addKeyword(string $keyword): void
    {
        if (!in_array($keyword, $this->metaData['site_keywords'], true)) {
            $this->metaData['site_keywords'][] = $keyword;
        }
    }

    /**
     * 移除关键词
     *
     * @param string $keyword
     */
    public function removeKeyword(string $keyword): void
    {
        $key = array_search($keyword, $this->metaData['site_keywords'], true);
        if ($key !== false) {
            unset($this->metaData['site_keywords'][$key]);
            $this->metaData['site_keywords'] = array_values($this->metaData['site_keywords']);
        }
    }

    /**
     * 以 JSON 格式输出元数据
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->metaData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}

// 示例用法
$meta = new SiteMeta();

// 输出简短描述
echo $meta->generateShortDescription() . PHP_EOL;

// 输出 HTML meta 标签
echo PHP_EOL . $meta->generateMetaTags() . PHP_EOL;

// 输出 JSON
echo PHP_EOL . $meta->toJson() . PHP_EOL;