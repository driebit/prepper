<?php

namespace Driebit\Prepper\Resetter;

use Doctrine\ODM\MongoDB\DocumentManager;

class MongoDbResetter implements ResetterInterface
{
    private $documentManager;
    
    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }
    
    public function reset()
    {
        $schemaManager = $this->documentManager->getSchemaManager();
        $schemaManager->dropDatabases();
    }
}
