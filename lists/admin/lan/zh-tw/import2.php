<?php
$lan = array (
  'The temporary directory for uploading (%s) is not writable, so import will fail' => '上傳資料的暫存資料夾 (%s) 無法寫入，匯入程序將無法順利進行',
  'Invalid Email' => '錯誤的信箱',
  'Import cleared' => '匯入資料清除了',
  'Continue' => '繼續',
  'Reset Import session' => '重新設定匯入連線',
  'File is either too large or does not exist.' => '檔案太大或是不存在',
  'No file was specified. Maybe the file is too big? ' => '沒有指定檔案，或者檔案太大？',
  'File too big, please split it up into smaller ones' => '檔案太大，請先切割成較小的多個檔案',
  'Use of wrong characters in filename: ' => '檔案名稱使用了錯誤的字元：',
  'Please choose whether to sign up immediately or to send a notification' => '請選擇要立即登錄還是要先寄送提醒通知',
  'Cannot read %s. file is not readable !' => '無法讀取 %s ！',
  'Something went wrong while uploading the file. Empty file received. Maybe the file is too big, or you have no permissions to read it.' => '上傳檔案時發生錯誤，檔案是空的；也許是檔案太大，或是您沒有讀取的權限。',
  'Reading emails from file ... ' => '從檔案讀取電子郵件...',
  'Error was around here &quot;%s&quot;' => '錯誤大約在&quot;%s&quot;',
  'Illegal character was %s' => '錯誤的字元為 %s',
  'A character has been found in the import which is not the delimiter indicated, but is likely to be confused for one. Please clean up your import file and try again' => '匯入的資料發現一個造成辨識錯誤的字元，這應該不是分隔字元；請先檢查匯入的檔案後再重試。',
  'ok, %d lines' => '完成 %d 行',
  'Cannot find column with email, please make sure the column is called &quot;email&quot; and not eg e-mail' => '無法找到 email 欄位，請確認其中一個欄位名稱為 &quot;email&quot; 而不是像 e-mail',
  'Create new one' => '建立新的',
  'Skip Column' => '忽略欄位',
  'Import Attributes' => '匯入屬性',
  'Please identify the target of the following unknown columns' => '請指定下面這些不知名欄位的對應資訊',
  'Summary' => '概要',
  'maps to' => '對應到',
  'Create new Attribute' => '建立新屬性',
  '%d lines will be imported' => '%d 行資料將被匯入',
  'Confirm Import' => '確認匯入',
  'Test Output' => '測試輸出',
  'Record has no email' => '資料沒有電子郵件',
  'clear value' => '清除資料',
  'New Attribute' => '新增屬性',
  'Skip value' => '忽略數值',
  'duplicate' => '重複',
  'Duplicate Email' => '重複的電子郵件',
  ' user imported as ' => ' 使用者匯入於',
  'All the emails already exist in the database and are member of the lists' => '所有的電子郵件都已經存在，而且也訂閱了這個電子報',
  '%s emails succesfully imported to the database and added to %d lists.' => '%s 個電子郵件成功匯入到資料庫，並且訂閱了電子報 %d 。',
  '%d emails subscribed to the lists' => '%d 的電子郵件訂閱了這個電子報',
  '%s emails already existed in the database' => '%s 個電子郵件已經存在於資料庫中',
  '%d Invalid Emails found.' => '%d 個錯誤的電子郵件',
  'These records were added, but the email has been made up from ' => '這些記錄新增了，但是電子郵件已經被建立於',
  'These records were deleted. Check your source and reimport the data. Duplicates will be identified.' => '這些記錄刪除了，確認您的來源接著再重新匯入資料；重複的項目會被列出。',
  'User data was updated for %d users' => '更新了 %d 個使用者的資料',
  '%d users were matched by foreign key, %d by email' => '%d 個使用者符合外部鍵值， %d 來自電子郵件',
  'phplist Import Results' => '匯入結果',
  'Test output<br/>If the output looks ok, click %s to submit for real' => '測試輸出 <br/>如果輸出資料看來沒問題，點選  %s 來正式送出資料',
  'Import some more emails' => '匯入更多資料',
  'Adding users to list' => '新增使用者到電子報',
  'Select the lists to add the emails to' => '選擇新增電子郵件所訂閱的電子報',
  'No lists available' => '沒有任何電子報',
  'Add a list' => '新增電子報',
  'Select the groups to add the users to' => '選擇要新增使用者的群組',
  'automatically added' => '自動新增',
  'importintro' => '<p>您上傳的檔案必須在第一行包含匯入資料的欄位名稱，請確認電子郵件欄位名稱為 "email" 而不是 "e-mail" 或 "Email Address"；大小寫則不會影響。
    </p>
    如果資料欄位包含了一個名為 "Foreign Key" 的項目，這將會用來與電子報系統資料庫的使用者資訊進行同步更新，外部鍵值會在符合既有使用者時產生作用；這將會減慢匯入的程序。如果啟用了這個項目，沒有電子郵件的項目也可以進行資料交換，不過會產生一個 "Invalid Email" 替代。您可以接著搜尋 "invalid email" 來找到這些資料。外部鍵值的大小上限為 100 個字元。
    <br/><br/>
    <b>注意：</b>您必須使用純文字文件，不要上傳像是WORD文件之類的二進位檔案！
    <br/>',
  'uploadlimits' => '下面是您的伺服器限制：<br/>
資料上傳大小上限： <b>%s</b><br/>
單一檔案大小上限： <b>%s</b>
<br/>PHPlist 無法處理大於 1Mb 的檔案',
  'testoutput_blurb' => '如果您勾選 "測試輸出"，您會看到解析後的電子郵件列表，資訊並不會儲存到資料庫中；這是用來確認檔案格式正確與否，只會顯示前 50 筆資料。',
  'warnings_blurb' => '如果您勾選 "顯示警告"，您將會看到個別資料的警告訊息；警告訊息只會出現在 "測試輸出"時，實際匯入時會被忽略。',
  'omitinvalid_blurb' => '如果您勾選 "忽略錯誤資料"，錯誤的資料將不會新增；錯誤的資料指的是沒有包含電子郵件的項目。 其他的屬性會自動加入，例如如果找到一筆資料的國家欄位不存在，它會自動被新增到系統的國家清單中。',
  'assigninvalid_blurb' => '指定錯誤的功能是用來在使用者電子郵件格式錯誤時自動產生一個信箱，您可以使用 [ 與 ] 之間的數值來設定電子郵件。例如匯入的資料包含欄位像是 "First Name" 與 "Last Name"，您可以使用 "[first name] [last name]" 把這兩個欄位當作電子郵件的資料；而 [number] 的數值則用來插入匯入資料的流水號。',
  'overwriteexisting_blurb' => '如果您勾選 "覆蓋現有資料"，存在資料庫的使用者資訊會被匯入的資料所取代，使用者比對的方式是透過電子郵件或外部鍵值。',
  'retainold_blurb' => '如果您勾選 "保留舊的使用者信箱"，當兩個電子郵件因為重複而產生衝突時，舊的資料會被保留，並且建立一個重複的項目來儲存新資料。如果您沒有勾選，舊的資料將會被視為重複項目，而優先使用新的資料。',
  'sendnotification_blurb' => '如果您選擇 "寄送通知郵件" ，被新增的使用者會收到訂閱的確認訊息，讓使用者能夠自行決定是否訂閱。建議您使用這個功能，因為匯入的資料可能包含大量錯誤的信箱。',
  'phplist Import  Results' => '匯入結果',
  'File containing emails' => '檔案包含電子郵件數量',
  'Field Delimiter' => '欄位分隔字元',
  '(default is TAB)' => '(預設為TAB字元)',
  'Record Delimiter' => '資料分隔字元',
  '(default is line break)' => '(預設為斷行)',
  'Test output' => '測試輸出',
  'Show Warnings' => '顯示警告',
  'Omit Invalid' => '忽略錯誤',
  'Assign Invalid' => '指定錯誤',
  'Overwrite Existing' => '覆蓋現有資料',
  'Retain Old User Email' => '保留舊信箱',
  'Send&nbsp;Notification&nbsp;email' => '寄送提醒郵件',
  'Make confirmed immediately' => '立刻訂閱',
  'Import' => '匯入',

);
?>