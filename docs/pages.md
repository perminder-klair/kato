#Pages

To get a block of a system (non static) page

    $this->getPageBlock('block-name')

To get a block of no parent, that can be echoed anywhere in site

    $this->getPageBlock('block-name', false)

To get all blocks of a system (non static) page

    $this->getPageBlocks()