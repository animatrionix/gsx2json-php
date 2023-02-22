# 📑 GSX2JSON PHP - Google SpreadSheets JSON API Service


💾 gsx2json-php is a **small API for Google Sheets built on PHP**, no OAuth required.


> It is based on the **gsx2json API** built in Node.js by @55sketch.
> 
> https://github.com/55sketch/gsx2json


¡Thank You! 😁

## 👉 Install


Requirements:

* You must obtain an [API Key from Google](https://developers.google.com/sheets/api/guides/authorizing#APIKey) and you can add it in the `gsheets.php` file.    
* You must Enable the Google Spreadsheet API and set up a service account.
* Your Google Spreadsheet must be set to share with "anyone who has the link".

Launch API:

* You must copy the `gsheets.php` file to a directory on your PHP server.

The Script has been tested on a shared server and it works great.

## ▶️ API Usage


Can you use the api by calling the file at url:

    `https://example.com/gsheets.php?`

And send the corresponding variables:

* id(required): The ID of your document in Google Spreadsheets.
* sheet(required): The name of the sheet from which you want to get the data.
* api_key(required): API Key generated from your Google Developer account.
* q(optional): Word or Phrase to filter in the results.
* integers(optional): If false, returns numbers as a string. Default is True.
* rows(optional): If false, it will only return column results. Default is True.
* columns(optional): If false, it will only return row results. Default is True.


🔸 You must send the variables required in the request to the url, for example:

    `https://example.com/gsheets.php?id=DOCUMENT_ID&sheet=SHEET_NAME&api_key=YOUR_API_KEY`

### 👉 Sample Response

    {
    	columns: [
    		"user",
    		"country"
    	],
    	rows: [
    		{
    		user: "Zuko",
    		country: "Japan"
    		},
    		{
    		user: "Carlos",
    		country: "Spain"
    		},
    		{
    		user: "George",
    		country: "United States"
    		}
    	]
    }
    
## ▶️ How can you help?


* Did you find a Bug?, Report it in: https://github.com/animatrionix/gsx2json-php/issues
* Do you want to Contribute?, Submit an [enhancement](https://github.com/animatrionix/gsx2json-php/issues?q=is%3Aissue+is%3Aopen+label%3Aenhancement).


¡Thank you very much! 😁
