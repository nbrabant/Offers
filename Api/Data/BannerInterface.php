<?php

namespace Nbrabant\Offers\Api\Data;

/**
 * Interface BannerInterface
 * @package Nbrabant\Offers\Api\Data
 */
interface BannerInterface
{
    /**
     * Get banner id.
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get banner label.
     *
     * @return string
     */
    public function getLabel(): string;

    /**
     * Set banner label.
     *
     * @param string $label
     * @return BannerInterface
     */
    public function setLabel(string $label): BannerInterface;

    /**
     * Get banner image source.
     *
     * @return string
     */
    public function getImageSrc(): string;

    /**
     * Set banner image source.
     *
     * @param string $imageSrc
     * @return BannerInterface
     */
    public function setImageSrc(string $imageSrc): BannerInterface;

    /**
     * Get banner link.
     *
     * @return string
     */
    public function getLink(): string;

    /**
     * Set banner link.
     *
     * @param string $link
     * @return BannerInterface
     */
    public function setLink(string $link): BannerInterface;

    /**
     * Get banner category Ids.
     *
     * @return string
     */
    public function getCategoryIds(): string;

    /**
     * Set banner category Ids.
     *
     * @param string $categoryIds
     * @return BannerInterface
     */
    public function setCategoryIds(string $categoryIds): BannerInterface;

    /**
     * Get banner start publish date.
     *
     * @return \DateTimeInterface
     */
    public function getFromDate(): \DateTimeInterface;

    /**
     * Set banner start publish date.
     *
     * @param \DateTimeInterface $fromDate
     * @return BannerInterface
     */
    public function setFromDate(\DateTimeInterface $fromDate): BannerInterface;

    /**
     * Get banner end publish date.
     *
     * @return \DateTimeInterface|null
     */
    public function getToDate(): ?\DateTimeInterface;

    /**
     * Set banner end publish date.
     *
     * @param \DateTimeInterface|null $toDate
     * @return BannerInterface
     */
    public function setToDate(?\DateTimeInterface $toDate): BannerInterface;

}
