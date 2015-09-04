<?php
/**
 * Class DirectoryList
 */
class DirectoryList implements Iterator, Countable, SeekableIterator
{
    private $items = array();
    private $current = 0;
    private $path;

    /**
     * @param null $path
     */
    public function __construct($path = null)
    {
        if ($path !== null) {
            $this->setPath($path);
        }
    }

    /**
     * Set the path to index.
     * @param string $path
     * @return DirectoryList $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        $this->resetState();

        if (file_exists($path) && is_dir($path)) {
            $this->indexPath();
        }

        return $this;
    }

    /**
     * Reset class state to an empty one.
     */
    protected function resetState()
    {
        $this->items = array();
        $this->current = 0;
    }

    /**
     * Fill the class' items property with File and Directory classes.
     */
    protected function indexPath()
    {
        $directoryIterator = new DirectoryIterator($this->path);
        if (empty($directoryIterator)) {
            return;
        }

        foreach ($directoryIterator as $fileOrDirectory) {
            if ($fileOrDirectory->isDot() !== true) {
                $this->items[] = $fileOrDirectory->isDir() ?
                    new DirectoryInstance($fileOrDirectory) :
                    new FileInstance($fileOrDirectory);
            }
        }
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->items[$this->current];
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->current++;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->current;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return isset($this->items[$this->current]);
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->current = 0;
    }

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * Seeks to a position
     * @link http://php.net/manual/en/seekableiterator.seek.php
     * @param int $position The position to seek to.
     * @return void
     * @since 5.1.0
     */
    public function seek($position)
    {
        if (!isset($this->items[$position])) {
            throw new OutOfBoundsException("Invalid seek position ($position)");
        }

        $this->current = $position;
    }
}
