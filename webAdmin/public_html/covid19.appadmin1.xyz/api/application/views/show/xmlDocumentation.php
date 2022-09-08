<!doctype html>
<html lang="en">


<head>

   
    <meta charset="utf-8">
    <title>Monopolion XML Documentation</title>
    <link rel="icon" href="<?php echo site_url("assets/"); ?>assets/img/favicon.ico" sizes="16x16" type="image/icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Monopolion Real Estate Software">
	
	
  	<?php $this->load->view("header/header.php") ?>
   
   	<style>
		.margin-b-3{
			margin-bottom: 3px;
		}
	</style>
    
    <section class="min-vh-100 mt-5" style="padding-top:0px;">
    
    <div class="container">
        <div class="row justify-content-center">
          <div class="col">
            <h2>Monopolion XML Documentation</h2>
            
            <p>Welcome to Monopolion Platform, For sending us properties xml file you need to get <code>id</code>, <code>auth key</code> and <code>unique email</code> from us by contacting us at <a href="mailTo:management@monopolion.com">management@monopolion.com</a></p>
            
            <p>Below is the XML format of properties and agents for parsing your data into the monopolion CRM</p>
            
            <pre style="background: #f7f7f7;padding: 0px 20px;">
            <code style="color:#e83e8c;">
<?php echo htmlentities('<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE UploadXML SYSTEM "ExportProperty_v1_1.dtd">

<UploadXML>
  <AccountDetails>
    <id>xx</id>
    <authKey>xxxxxxxxxx</authKey>
    <email>company@domain.com</email>
  </AccountDetails>
  <listings>
    <listing>
      <referenceNumber>Unique Reference# of Property</referenceNumber>
      <status>Property status inactive or active</status>
      <isSold></isSold>
      <title>Property Title</title>
      <type></type>
      <propertyType></propertyType>
      <category></category>
      <currency>EUR</currency>
      <currencySign>‎‎€</currencySign>
      <price>100000</price>
      <vat>True</vat>
      <featured>True</featured>
      <address>
	  <cityID></cityID>
	  <subareaID></subareaID>
	  <street></street>
	  <country></country>
	  <postalCode></postalCode>
	  <lat></lat>
	  <lng></lng>
      </address>
      <yearBuilt>2005</yearBuilt>
      <bathrooms></bathrooms>
      <roomSize></roomSize>
      <bedrooms></bedrooms>
      <kitchens></kitchens>
      <floors></floors>
      <petsAllowed>True</petsAllowed>
      <parkings>2</parkings>
      <coveredParking>1</coveredParking>
      <uncoveredParking>1</uncoveredParking>
      <furnished>2</furnished>
      <plotArea>If its a plot</plotArea>
      <coveredArea>1000</coveredArea>
      <uncoveredArea>500</uncoveredArea>
      <architecturalDesign></architecturalDesign>
      <energyEfficiency>A</energyEfficiency>
      <propertyStage></propertyStage>
      <fullDescription>
        <![CDATA[ Some Description ]]>
      </fullDescription>
      <personalNotes>
        <![CDATA[ Personal Notes ]]>
      </personalNotes>
      <developerName></developerName>
      <facilities>
        <facility>
          <id>5</id>
          <category>Indoor, Outdoor or Electrical...</category>
        </facility>
        <facility>
          <id>6</id>
          <category>Indoor, Outdoor or Electrical...</category>
        </facility>
      </facilities>
      <media>
        <photos>
          <image>
            <url>
              <![CDATA[ Full URL of property Image ]]>
            </url>
            <order>1</order>
            <title>Some Title</title>
          </image>
          <image>
            <url>
              <![CDATA[ Full URL of property Image ]]>
            </url>
            <order>2</order>
            <title>Some Title</title>
          </image>
        </photos>
        <youtube>
          <![CDATA[ Youtube video url ]]>
        </youtube>
        <virtual360Video>
          <![CDATA[ ]]>
        </virtual360Video>
        <audioTourLink>
          <![CDATA[ ]]>
        </audioTourLink>
        <videoTourLink>
          <![CDATA[ ]]>
        </videoTourLink>
        <qrCodeLink>
          <![CDATA[ ]]>
        </qrCodeLink>
      </media>
      <agent>
        <email></email>
        <photo>
          <![CDATA[ Full url of agent photo ]]>
        </photo>
        <fname></fname>
        <lname></lname>
        <password>
          <![CDATA[If any password]]>
        </password>
        <mobileCode>+357</mobileCode>
        <mobileNumber>1234567</mobileNumber>
        <phoneCode>+357</phoneCode>
        <phoneNumber>1234567</phoneNumber>
        <jobTitle></jobTitle>
        <bio>
          <![CDATA[Details about agent]]>
        </bio>
        <department></department>
        <status>Agent status inactive or active</status>
      </agent>
    </listing>
  </listings>
</UploadXML>');
?>
            </code>
            </pre>
            
            <br>
            <p style="text-decoration:underline;text-decoration-color:#495057;"><b>Note:</b> You can parse multiple properties inside <code>listings</code> xml tag. Parse only new properties and those properties which you want to make inactive. All the mandatory fields will have <code>(*)</code> at the end. Let's go through from each xml tag with explanation on it.</p>
            
            <h4 class="margin-b-3"><code>&lt;referenceNumber&gt;</code><code>*</code></h4>      
            <p>You have to parse unique reference number of each property so it can be tracked easily to add and update this listing on our crm.</p>
            
            
            <h4 class="margin-b-3"><code>&lt;status&gt;</code><code>*</code></h4>      
            <p>Status value can be <code>active</code> or <code>inactive</code> for making this property published or unpublished in our crm system.</p>
            
            <h4 class="margin-b-3"><code>&lt;isSold&gt;</code></h4>      
            <p>If property has been sold or rented then set <code>True</code> value inside this xml tag. Default value will be <code>False</code>.</p>
            
            <h4 class="margin-b-3"><code>&lt;title&gt;</code><code>*</code></h4>      
            <p>It will contain the property title to be appear as a top heading of this property.</p>
            
            <h4 class="margin-b-3"><code>&lt;type&gt;</code><code>*</code></h4>      
            <p>You have to send value <code>1</code> for Sale/Buy properties and <code>2</code> for Rent properties <code>[1=>Buy, 2=>Rent]</code>.</p>
            
            
            <h4 class="margin-b-3"><code>&lt;propertyType&gt;</code><code>*</code></h4>      
            <p>You have to send value <code>0</code> for Residential properties and <code>1</code> for Commercial properties <code>[0=>Residential, 1=>Commercial]</code>.</p>
            
            <h4 class="margin-b-3"><code>&lt;category&gt;</code><code>*</code></h4>      
            <p>You have to send <code>category id</code> from below given table. If its a Apartment then send <code>1</code> as a category id.</p>
            
            <table class="table table-bordered">
            <thead>
            <tr>
            <th>Category id</th>
            <th>Category Name</th>
            <th>Property Type</th>
            </tr>
            </thead>
            <tbody><tr>
            <td>1</td>
            <td>Apartment</td>
            <td>Residential</td>
            </tr>
            <tr>
            <td>2</td>
            <td>Bungalow</td>
            <td>Residential</td>
            </tr>
            <tr>
            <td>3</td>
            <td>Duplex</td>
            <td>Residential</td>
            </tr>
            <tr>
            <td>4</td>
            <td>Garden Apartment</td>
            <td>Residential</td>
            </tr>
            <tr>
            <td>5</td>
            <td>House</td>
            <td>Residential</td>
            </tr>
            <tr>
            <td>6</td>
            <td>Maisonette</td>
            <td>Residential</td>
            </tr>
            <tr>
            <td>7</td>
            <td>Penthouse</td>
            <td>Residential</td>
            </tr>
            <tr>
            <td>8</td>
            <td>Land</td>
            <td>Residential</td>
            </tr>
            <tr>
            <td>9</td>
            <td>Villa</td>
            <td>Residential</td>
            </tr>
            <tr>
            <td>10</td>
            <td>Studio</td>
            <td>Residential</td>
            </tr>
            <tr>
            <td>11</td>
            <td>Townhouse</td>
            <td>Residential</td>
            </tr>
            <tr>
            <td>12</td>
            <td>Upper-House</td>
            <td>Residential</td>
            </tr>
            <tr>
            <td>13</td>
            <td>Other</td>
            <td>Residential</td>
            </tr>
            <tr>
            <td>14</td>
            <td>Office</td>
            <td>Commercial</td>
            </tr>
            <tr>
            <td>15</td>
            <td>Shop</td>
            <td>Commercial</td>
            </tr>
            <tr>
            <td>16</td>
            <td>Building</td>
            <td>Commercial</td>
            </tr>
            <tr>
            <td>17</td>
            <td>Business</td>
            <td>Commercial</td>
            </tr>
            <tr>
            <td>18</td>
            <td>Hotel</td>
            <td>Commercial</td>
            </tr>
            <tr>
            <td>19</td>
            <td>Industrial Estate</td>
            <td>Commercial</td>
            </tr>
            <tr>
            <td>20</td>
            <td>Restaurant</td>
            <td>Commercial</td>
            </tr>
            <tr>
            <td>21</td>
            <td>Land</td>
            <td>Commercial</td>
            </tr>
            <tr>
            <td>22</td>
            <td>Other</td>
            <td>Commercial</td>
            </tr>

            </tbody></table>
            
            
            <h4 class="margin-b-3"><code>&lt;currency&gt; and &lt;currencySign&gt;</code><code>*</code></h4>      
            <p>Send ISO3 currency code inside <code>currency</code> tag and correponding currency sign <u>(not mandatory)</u> inside <code>currencySign</code> tag.
            <br>See currency code list: <a href="https://www.iban.com/currency-codes" target="_blank">https://www.iban.com/currency-codes</a>
            
            </p>
            
            
            <h4 class="margin-b-3"><code>&lt;price&gt;</code><code>*</code></h4>      
            <p>Send full price of property inside this tag according to above mentioned currency.</p>
            
            <h4 class="margin-b-3"><code>&lt;vat&gt;</code><code>*</code></h4>      
            <p>Send <code>True</code> if its a VAT Plus property otherwise send <code>False</code> if its not a VAT plus property.</p>
            
            <h4 class="margin-b-3"><code>&lt;featured&gt;</code></h4>      
            <p>Send <code>True</code> if its a featured property otherwise send <code>False</code> if its not a featured property.</p>
            
             <h4 class="margin-b-3"><code>&lt;cityID&gt;</code><code>*</code></h4>      
            <p>You have to send  city ID according to your selected country in this tag. <br><a href="<?php echo site_url("show/countries"); ?>">See all supported countries, cities and areas ID</a></p>
            
             <h4 class="margin-b-3"><code>&lt;subareaID&gt;</code></h4>      
            <p>You have to send  sub-area ID according to your selected city in this tag. <br><a href="<?php echo site_url("show/countries"); ?>">See all supported countries, cities and areas ID</a></p>
            
            
            <h4 class="margin-b-3"><code>&lt;street&gt;</code></h4>      
            <p>Send street address inside this tag.</p>
            
            <h4 class="margin-b-3"><code>&lt;country&gt;</code><code>*</code></h4>      
            <p>Send iso2 country code inside this tag e.g <code>uk, cy or gr</code>. <br><a href="<?php echo site_url("show/mobilecountrycode"); ?>">See all country iso2 code list</a></p>
            
            <h4 class="margin-b-3"><code>&lt;postalCode&gt;</code></h4>      
            <p>Send postal code of city or area inside this tag.</p>
            
            <h4 class="margin-b-3"><code>&lt;lat&gt;</code></h4>      
            <p>Send exact latitude of property location inside this tag.</p>
            
            <h4 class="margin-b-3"><code>&lt;lng&gt;</code></h4>      
            <p>Send exact longitude of property location inside this tag.</p>
            
            <h4 class="margin-b-3"><code>&lt;yearBuilt&gt;</code></h4>      
            <p>Send year of construction of this property inside this tag e.g <code>2010</code>.</p>
            
            <h4 class="margin-b-3"><code>&lt;bathrooms&gt;</code></h4>      
            <p>Send number of bathrooms this property contains e.g <code>4</code>.</p>
            
            <h4 class="margin-b-3"><code>&lt;bedrooms&gt;</code></h4>      
            <p>Send number of bedrooms this property contains e.g <code>4</code>.</p>
            
            <h4 class="margin-b-3"><code>&lt;roomSize&gt;</code></h4>      
            <p>Send room size value inside this tag like <code>1</code> for small, <code>2</code> for medium and <code>3</code> for large room size properties <code>[1=>Small, 2=>Medium, 3=>Large]</code>.</p>
            
            <h4 class="margin-b-3"><code>&lt;kitchens&gt;</code></h4>      
            <p>Send number of kitchens this property contains e.g <code>2</code></p>
            
            <h4 class="margin-b-3"><code>&lt;floors&gt;</code></h4>      
            <p>Send number of floors this property contains e.g <code>2</code>.</p>
            
            <h4 class="margin-b-3"><code>&lt;petsAllowed&gt;</code></h4>      
            <p>Send <code>True</code> if pets allowed and <code>False</code> if pets are not allowed in this property.</p>
            
            <h4 class="margin-b-3"><code>&lt;parkings&gt;</code></h4>      
            <p>Send number of parkings this property contains e.g <code>3</code>.</p>
            
            <h4 class="margin-b-3"><code>&lt;coveredParking&gt;</code></h4>      
            <p>Specify how many parkings are covered parkings e.g <code>2</code>.</p>
            
            <h4 class="margin-b-3"><code>&lt;uncoveredParking&gt;</code></h4>      
            <p>Specify how many parkings are uncovered parkings e.g <code>1</code>.</p>
            
            
            <h4 class="margin-b-3"><code>&lt;furnished&gt;</code></h4>      
            <p>Send value <code>1</code> if its a furnished property e.g <code>[1=>Furnished, 2=>Un-Furnished, 3=>Partly Furnished]</code>.</p>
            
            <h4 class="margin-b-3"><code>&lt;plotArea&gt;</code></h4>      
            <p>Send plot area in meter square (m²) if its a plot e.g <code>150</code>.</p>
            
            <h4 class="margin-b-3"><code>&lt;coveredArea&gt;</code></h4>      
            <p>Send covered area in meter square (m²) e.g <code>100</code>.</p>
            
            <h4 class="margin-b-3"><code>&lt;uncoveredArea&gt;</code></h4>      
            <p>Send uncovered area in meter square (m²) e.g <code>50</code>.</p>
            
            <h4 class="margin-b-3"><code>&lt;architecturalDesign&gt;</code></h4>      
            <p>Send value <code>1</code> if its a contemporary architectural design e.g <code>[1=>Contemporary, 2=>Modern, 3=>Classic]</code>.</p>
            
            <h4 class="margin-b-3"><code>&lt;energyEfficiency&gt;</code></h4>      
            <p>Send single energy efficiency value <code>From A to G</code> e.g <code>A</code>.</p>
            
            <h4 class="margin-b-3"><code>&lt;propertyStage&gt;</code></h4>      
            <p>Send value <code>1</code> if its a Existing Home e.g <code>[0=>Any, 1=>Existing Home, 2=>New Construction]</code>.</p>
            
            <h4 class="margin-b-3"><code>&lt;fullDescription&gt;</code><code>*</code></h4>      
            <p>Send full description of property after encoding it into the <code>htmlentities</code> PHP function.</p>
            
            <h4 class="margin-b-3"><code>&lt;personalNotes&gt;</code></h4>      
            <p>Send personal notes of property after encoding it into the <code>htmlentities</code> PHP function.</p>
            
            <h4 class="margin-b-3"><code>&lt;developerName&gt;</code></h4>      
            <p>Send developer name of this property inside this tag.</p>
            
            <h4 class="margin-b-3"><code>&lt;facility&gt;</code></h4>      
            <p>You can send multiple facilities for each property inside <code>&lt;facilities&gt;</code> tag. You need to send <code>&lt;id&gt;</code> and <code>&lt;category&gt;</code> value for each facility. <br><a href="<?php echo site_url("show/propfacilities"); ?>">See full list of property facilities with facility id and category id here</a>.</p>
            
            <h4 class="margin-b-3"><code>&lt;image&gt;</code></h4>      
            <p>You can send multiple images inside <code>&lt;media&gt;</code>-><code>&lt;photos&gt;</code> tag. Send full url of image inside <code>&lt;url&gt;</code> tag, order of image inside this <code>&lt;order&gt;</code> tag and title of image inside this <code>&lt;title&gt;</code> tag.</p>
            
            <h4 class="margin-b-3"><code>&lt;youtube&gt;</code>,<code>&lt;virtual360Video&gt;</code>,<code>&lt;audioTourLink&gt;</code>,<code>&lt;videoTourLink&gt;</code>,<code>&lt;qrCodeLink&gt;</code></h4> 
            
            <p>Send full url of each platform video, audio or qr link in each tag.</p>
            
            <h4 class="margin-b-3"><code>&lt;agent&gt;</code></h4>      
            
            <div style="padding-left:20px;margin-top:5px;">
            	
            	<h4 class="margin-b-3"><code>&lt;email&gt;</code><code>*</code></h4> 
                
                <p>Send email address of agent.</p>
                
            	<h4 class="margin-b-3"><code>&lt;photo&gt;</code></h4> 
                
                <p>Send full url of agent's profile picture.</p>
                
                <h4 class="margin-b-3"><code>&lt;fname&gt;</code><code>*</code></h4> 
                
                <p>Send first name of the agent in this tag.</p>
                
                <h4 class="margin-b-3"><code>&lt;lname&gt;</code><code>*</code></h4> 
                
                <p>Send last name of the agent in this tag.</p>
                
                <h4 class="margin-b-3"><code>&lt;password&gt;</code></h4> 
                
                <p>Send real password of the agent without encoding and hash on it. If agent wants to login from our website.</p>
                
                <h4 class="margin-b-3"><code>&lt;mobileCode&gt;</code><code>*</code></h4> 
                
                <p>Send mobile country code in this tag.<br><a href="<?php echo site_url("show/mobilecountrycode"); ?>">See all country dial code list</a>.</p>
                
                <h4 class="margin-b-3"><code>&lt;mobileNumber&gt;</code><code>*</code></h4> 
                
                <p>Send mobile number in this tag without country code in prefix.</p>
                
                <h4 class="margin-b-3"><code>&lt;phoneCode&gt;</code></h4> 
                
                <p>Send phone country code in this tag.<br><a href="<?php echo site_url("show/mobilecountrycode"); ?>">See all country dial code list</a>.</p>
                
                <h4 class="margin-b-3"><code>&lt;phoneNumber&gt;</code></h4> 
                
                <p>Send phone number in this tag without country code in prefix.</p>
                
                <h4 class="margin-b-3"><code>&lt;jobTitle&gt;</code></h4> 
                
                <p>Send job title of the agent in this tag.</p>
                
                <h4 class="margin-b-3"><code>&lt;bio&gt;</code></h4> 
                
                <p>Send bio of the agent in this tag.</p>
                
                <h4 class="margin-b-3"><code>&lt;department&gt;</code></h4> 
                
                <p>Send department name of the agent in this tag.</p>
                
                 <h4 class="margin-b-3"><code>&lt;status&gt;</code><code>*</code></h4> 
                
                <p>Status value can be <code>active</code> or <code>inactive</code> for making this agent active or inactive in our crm system.</p>
                
                
            </div>
            
            
            
            
          </div>
        </div>
      </div>
      
    </section>
    
    <?php $this->load->view("footer/footer.php") ?>

<!-- Mirrored from leap.mediumra.re/account-sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Mar 2019 19:25:29 GMT -->
</html>
