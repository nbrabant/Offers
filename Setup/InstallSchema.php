<?php

namespace Nbrabant\Offers\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Nbrabant\Offers\Api\Data\BannerResourceInterface;

/**
 * Class InstallData
 * @package Nbrabant\Offers\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $table = $setup->getConnection()
            ->newTable($setup->getTable(BannerResourceInterface::TABLE_NAME))
            ->addColumn(
                BannerResourceInterface::BANNER_ID,
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Offer banner ID'
            )
            ->addColumn(
                BannerResourceInterface::LABEL,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Label permettant de nommer l’offre'
            )
            ->addColumn(
                BannerResourceInterface::IMAGE_SRC,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Image de l’offre'
            )
            ->addColumn(
                BannerResourceInterface::LINK,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Lien de redirection'
            )
            ->addColumn(
                BannerResourceInterface::CATEGORY_IDS,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Liste des catégories liées'
            )
            ->addColumn(
                BannerResourceInterface::FROM_DATE,
                Table::TYPE_DATE,
                null,
                ['nullable' => false],
                'Date de début d’affichage'
            )
            ->addColumn(
                BannerResourceInterface::TO_DATE,
                Table::TYPE_DATE,
                null,
                ['nullable' => true, 'default' => null],
                'Date de fin d’affichage'
            )
            ->addIndex(
                $setup->getIdxName(
                    BannerResourceInterface::TABLE_NAME,
                    [BannerResourceInterface::CATEGORY_IDS]
                ),
                [BannerResourceInterface::CATEGORY_IDS]
            );

        $setup->getConnection()->createTable($table);
    }
}
