Ability to use envvars in Magento config
========================================

In our development workflow, our  webservers provide environment configuration information to our applications via environment variables (i.e. MAGE_DB_HOST, MAGE_DB_USER etc). This doesn't sit well with Magento's XML based configuration approach.

This little hack allows us to use '$MAGE_DB_HOST' and any other environment variables in our XML configuration files.

You can also specify a default value in case the envvar is missing or empty by appending it with double pipe symbols (e.g. '$MAGE_DB_HOST||localhost').


Usage
-----

Example part of our local.xml...

```xml
...
            <default_setup>
                <connection>
                    <host>$MAGE_DB_HOST</host>
                    <username>$MAGE_DB_USER</username>
                    <password>$MAGE_DB_PASS</password>
                    <dbname>$MAGE_DB_NAME</dbname>
                    <initStatements><![CDATA[SET NAMES utf8]]></initStatements>
                    <model><![CDATA[mysql4]]></model>
                    <type><![CDATA[pdo_mysql]]></type>
                    <pdoType></pdoType>
                    <active>1</active>
                </connection>

...
```

