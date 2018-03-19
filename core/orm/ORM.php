<?php
/**
 * This file is part of orm.
 *
 * orm is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * orm is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with orm.  If not, see <http://www.gnu.org/licenses/>.
 *
 * PHP version 5.4
 *
 * @category Core
 * @package  orm
 * @author   iNem0o <contact@inem0o.fr>
 * @license  LGPL http://opensource.org/licenses/lgpl-license.php
 * @link     https://github.com/iNem0o/PicORM
 */
namespace Core\ORM;

/**
 * Class orm
 * Static class to configure libraries from user option
 *
 * @category Core
 * @package  orm
 *
 */
class ORM
{
    /**
     * Datasource instance
     *
     * @var \PDO
     */
    protected static $_dataSource;

    /**
     * Configuration array
     *
     * @var array
     */
    protected static $_configuration;

    /**
     * Default orm configuration
     *
     * @var array
     */
    protected static $_defaultConfiguration = array(
        'cache'      => false, // !!TODO!!
        'data_source' => null
    );


    /**
     * Set orm global configuration
     *
     * @param array $configuration
     *
     * @throws Exception
     */
    final public static function configure(array $configuration)
    {
        // override with default configuration if not present
        $configuration += static::$_defaultConfiguration;

        // test if data_source is a PDO instance
        if ($configuration['data_source'] === null || !$configuration['data_source'] instanceof \PDO) {
            throw new Exception("PDO Data Source is required!");
        }

        // set global data_source for all model
        static::$_dataSource = $configuration['data_source'];
        Model::setDataSource(static::$_dataSource);

        // store orm configuration
        static::$_configuration = $configuration;
    }

    /**
     * Return main datasource extracted from configuration
     * @return \PDO
     */
    public static function getDataSource()
    {
        return static::$_dataSource;
    }
}