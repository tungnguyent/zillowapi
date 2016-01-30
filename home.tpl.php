<?php 
$result = $this->searchResult;
?>

<section class=result-section>
    <div class="result-detail">
        <h1 class="result-header">Search result</h1>
        <?php if($result->message->code == 0) { 
            $home = $result->response->results->result;
        ?>
        <div class="home-detail">
            <div class="address">
                <p>
                    <span class="street"><?php echo $home->address->street ?></span>
                    <span class="citystatezip"><?php echo $home->address->city ?>, <?php echo $home->address->state ?> <?php echo $home->address->zipcode ?></span>
                
                <a href="<?php echo $home->links->homedetails ?>">More details from Zillow</a>
            </div>
            <div class="estimate">
                <h2>Zestimate property value: <?php echo sprintf("$%01.0f", $home->zestimate->amount); ?></h2>
                <table>
                    <tbody>
                    <tr>
                      <th>Low property price</th>
                      <th>High property price</th>
                    </tr>
                    <tr>
                      <td class="price-range"><?php echo sprintf("$%01.0f",  $home->zestimate->valuationRange->low); ?></td>
                      <td class="price-range"><?php echo sprintf("$%01.0f",  $home->zestimate->valuationRange->high); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                      <td><strong>Value Change:</strong></td>
                      <td><?php echo $home->zestimate->valueChange; ?></td>
                    </tr>
                    <tr>
                      <td><strong>Price in <?php echo $home->localRealEstate->region->attributes()->name; ?></strong></td>
                      <td><?php echo "$". $home->localRealEstate->region->zindexValue; ?></td>
                    </tr>
                  </tbody>
              </table>
            </div>
    
        </div>
       
        <?php } elseif ($result->message->code >= 500) { ?>
            <p>No home matched this address</p>
        <?php } else { ?>
            <p>Error has occured. Please try to search later</p>
        <?php }  ?>
        </div>
</section>


