<?php
/**
 * Rewindable Entity Iterator
 *
 * @author Ben Helgeson
 */

namespace org\mizer;

class RewindableEntityIterator extends EntityIterator
{
  public $next;
  
  /**
   * Constructor
   *
   * @param ResultSet $rs
   * @param DataMapper $dataMapper
   */
  public function __construct(ResultSet $rs, DataMapper $dataMapper) {
	
	$this->rs         = $rs;
	$this->cacheRs    = clone $rs;
	$this->dataMapper = $dataMapper;
	$this->cacheDM    = clone $dataMapper;
	$this->index      = -1; 
  }
	
  public function rewind() {
  
	// reset index everytime it's called 
	$this->index = -1;
	
	unset($this->rs);
	unset($this->dataMapper);
	
	// reset the resultSet
    $this->rs =  unserialize(serialize($this->cacheRs));
	$this->dataMapper =  unserialize(serialize($this->cacheDM));
	$this->next();
  }
}