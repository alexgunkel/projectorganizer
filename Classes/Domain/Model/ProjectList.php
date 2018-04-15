<?php
namespace AlexGunkel\ProjectOrganizer\Domain\Model;

/**
 *
 * @author alexander
 *        
 */
final class ProjectList implements \IteratorAggregate
{
    /**
     * 
     * @var array
     */
    private $list;

    /**
     */
    public function __construct(?array $projectArray = [])
    {
        $this->list = $projectArray;
    }
    
    public function getIterator(): array
    {
        return $this->list;
    }
    
    public function add(Project $project): void
    {
        $this->list[] = $project;
    }
    
    public function offsetGet($offset):? Project
    {
        if (isset($this->list[$offset])) {
            return $this->list[$offset];
        }
        
        return null;
    }

    public function offsetExists($offset): bool
    {
        return isset($this->list[$offset]);
    }

    public function offsetUnset($offset): void
    {
        if (isset($this->list[$offset])) {
            unset($this->list[$offset]);
        }
    }

    public function offsetSet(int $offset, Project $value)
    {
        $this->list[$offset] = $value;
    }

}
