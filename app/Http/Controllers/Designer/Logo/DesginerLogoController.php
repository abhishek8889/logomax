<?php

namespace App\Http\Controllers\Designer\Logo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Media;
use App\Models\Categories;
use App\Models\Logo;
use App\Models\Style;
use App\Models\Branch;
use App\Events\RegisterNotificationEvent;
use App\Models\Notifications;
// use File;
use Auth;
use App\Mail\LogoAddedByDesigner;
use Mail;
use Illuminate\Support\Facades\File;

use Illuminate\Http\UploadedFile;

use Intervention\Image\ImageManagerStatic as Image;
use Dompdf\Dompdf;
use Dompdf\Options;
use Imagecow\Image as ImageCow;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Imagick;
use \ConvertApi\ConvertApi;
use \CloudConvert\CloudConvert;
use \CloudConvert\Models\Job;
use \CloudConvert\Models\Task;

class DesginerLogoController extends Controller
{
   public function index(){
        $logos = Logo::where('designer_id',Auth::user()->id)->with('category','media')->get();
    //   dd($logos);
        return view('designer.logos.index',compact('logos'));
   }
   public function pendingLogos(){
    $logos = Logo::where([['designer_id',Auth::user()->id],['status',1],['approved_status',0]])->get();

    return view('designer.logos.pendinglogos',compact('logos'));
   }
   public function rejectedLogos(){
    $logos = Logo::where([['designer_id',Auth::user()->id],['status',1],['approved_status',2]])->get();

    return view('designer.logos.rejectedlogos',compact('logos'));
   
   }
   public function soldLogos(){
        $logos = Logo::where([['designer_id',Auth::user()->id],['status',3]])->get();

        return view('designer.logos.soldlogos',compact('logos'));
   }
   public function approvedLogos(){
        $logos = Logo::where([['designer_id',Auth::user()->id],['status',1],['approved_status',1]])->get();
        
        return view('designer.logos.approvedlogos',compact('logos'));
   }
    public function upload(Request $request,$slug = null){
        $categories = Categories::all();
        $tags = Tag::where('status',1)->get();
        $styles = Style::where('status',1)->get();
        $branches = Branch::where('status',1)->get();

        $logo_for_update = Logo::where('logo_slug',$slug)->first();
        return view('designer.logos.addlogos',compact('categories','tags','styles','branches','logo_for_update'));
    }
   
    public function uploadProc(Request $request){
        if(auth()->user()->is_approved !== 0 && auth()->user()->is_approved !== 2){
          
            if($request->hasFile('file')){
                
                // $potraceVersionCommand = "potrace --version";
                // exec($potraceVersionCommand, $versionOutput);
                // return 'Potrace version: ' . implode("\n", $versionOutput) . "\n";

                $file = $request->file('file');
                if($file->getClientOriginalExtension() != 'eps'){
                    return response()->json(['error'=>'The provided file format is incompatible for upload; kindly submit the document in the EPS format exclusively!']);
                }
                $namewithoutextension = 'Logo_'.time().rand(1,100);
                $name = $namewithoutextension.'.'.$file->getClientOriginalExtension();
                $filesize = getimagesize($file);
                $filesizekb = filesize($file);
                // $file->move(public_path().'/logos/', $name);
                // $file->move('logos1', $name,'public');
                $file->storeAs('logos', $name, 'public');
               
                $media = new Media;
                $media->image_name = $name;
                $media->image_path = '/logos/'.$name;
                // $media->image_size = ($filesizekb/1000).' KB';
                // $media->image_dimensions = $filesize[3];
                // $media->image_format = $filesize['mime'];
             
               
                // $imgPath = '/logos/'.$name;

                // $ImageConvertion = $this->ImageConvert($request);
                // $ImageConvertion = $this->ImageApiConvert($request,$name,$namewithoutextension);
                $ImageConvertion = $this->convertImageNewApi($request,$name,$namewithoutextension);
                
                $media->directory_name = $namewithoutextension;
                $media->save();
                // return response()->json();
                return response()->json($media);
            }else{
                $request->validate([
                    'logo_name' => 'required',
                    'logo_slug' => 'required|unique:logos,logo_slug,'.$request->id,
                    'categories' => 'required',
                    // 'tags' => 'required',
                    'style' => 'required',
                    'branch_id' => 'required',
                    'media_id' => 'required',
                ],[
                    'logo_name.required' => 'logo title is required',
                    'logo_slug.required' => 'logo slug is required',
                    'logo_slug.unique' => 'logo slug must be unique',
                    'categories.required' => 'logo style is required',
                    // 'tags.required' => 'tag is required',
                    'style.required' => 'logomark is required',
                    'branch_id.required' => 'Logo branch is required',
                    'media_id.required' => 'Please upload your logo',
                ]);
                if($request->id){
                    $logos = Logo::find($request->id);
                    $logos->logo_name = $request->logo_name;
                    $logos->logo_slug = $request->logo_slug;
                    $logos->media_id = $request->media_id;
                    $logos->tags = json_encode($request->tags);
                    $logos->category_id = json_encode($request->categories);
                    $logos->style_id = json_encode($request->style);
                    $logos->branch_id = json_encode($request->branch_id);
                    $logos->approved_status = 0;
                    $logos->status = 1;
                    $logos->designer_id = Auth::user()->id;
                    $logos->update();
                }else{
                    $uniqueId = mt_rand(100000000, 999999999);
                    $logos = new Logo;
                    $logos->logo_unique_id = $uniqueId;
                    $logos->logo_name = $request->logo_name;
                    $logos->logo_slug = $request->logo_slug;
                    $logos->media_id = $request->media_id;
                    $logos->tags = json_encode($request->tags);
                    $logos->category_id = json_encode($request->categories);
                    $logos->style_id = json_encode($request->style);
                    $logos->branch_id = json_encode($request->branch_id);
                    $logos->approved_status = 0;
                    $logos->status = 1;
                    $logos->designer_id = Auth::user()->id;
                    $logos->save();
                }
                    // Send notification to admin ::::::::: 
                    
                    $logo_id = $logos->id ; 
                    $notifications = Notifications::create(array(
                        'type' => 'logo-added',
                        'sender_id' => '0',
                        'reciever_id' => '0',
                        'designer_id' => Auth::user()->id,
                        'logo_id' => $logo_id,
                        'message' => 'New logo is <span>Added !</span>'
                    )); 
                    $eventData = array(
                        'type' => 'logo-added',
                        'designer_id' => Auth::user()->id,
                        'notification_id' => $notifications->id,
                        'logo_id' => $logo_id,
                        'read_url' => url('read-notification/'.$notifications->id),
                        'message' => 'New logo is <span>Added !</span>'
                    );
                
                event(new RegisterNotificationEvent($eventData));
                $mailData = array(
                    'logo_id' => $logo_id,
                    'logo_slug' => $logos->logo_slug,
                );
                $mail = Mail::to(env('ADMIN_MAIL'))->send(new LogoAddedByDesigner($mailData));

                return redirect()->back()->with('success','You have succesfully uploaded the logo !');
            }
        }else{
            return redirect()->back()->with('error','You are not able to upload any logo until your account is not approved !');
        }
    }


    public function addtag(Request $request){
        $tags = new Tag;
        $tags->name = $request->name;
        $tags->slug = $request->slug;
        $tags->status = 1;
        $tags->save();
        return response()->json($tags);
    }
    
    public function deleteimage(Request $request){
        $media = Media::find($request->mediaid);
        // return $media;

        $filepath = public_path('LogoDirectory/'.$media->directory_name);
        $imagepath = public_path('logos/'.$media->image_name);
        if(is_dir($filepath)){
            File::deleteDirectory($filepath);
        }
        if($imagepath){
            File::delete($imagepath);
        }
        if($media){
            $media->delete();
            return response()->json('deleted');
        }else{
            return response()->json('something went worng');
        }
    }
    // New conversion code using api
    public function ImageApiConvert($request,$logoname,$namewithoutextension){
        
        if ($request->hasFile('file')) {
            // $imagepath = 'https://logomax.com/public/logos/'.$logoname;
            $imagepath = asset('logos/'.$logoname);
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            // $name = 'Logo_' . rand(0, 1000) . '_' . time();
            $name = $namewithoutextension;
            $folderPath = public_path('LogoDirectory') . '/' . $name;
            $imageName = $name;
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            $jpgimagepath = $folderPath.'/'.$name.'.jpg';
             //////api code
             ConvertApi::setApiSecret('E0IGQOdISHcX3B5O');
             $result = ConvertApi::convert('jpg', [
                     'File' => $imagepath,
                 ], 'ai'
             );
             $result->getFile()->save($folderPath.'/'.$name.'.jpg');
       
             $result1 = ConvertApi::convert('png', [
                 'File' => $imagepath,
             ], 'ai'
              );
              $result1->saveFiles($folderPath);
             
              $result2 = ConvertApi::convert('svg', [
                 'File' => $imagepath,
                 ], 'ai'
             );
             $result2->saveFiles($folderPath);
 
             $result3 = ConvertApi::convert('tiff', [
                 'File' => $imagepath,
                 ], 'ai'
             );
             $result3->getFile()->save($folderPath.'/'.$name.'.tiff');
 
             $result4 = ConvertApi::convert('pdf', [
                 'File' => $jpgimagepath,
             ], 'jpg'
             );
             $result4->saveFiles($folderPath);
             
             return $name;
 
             // endapi code
    }
    }

    /* All function of image convertion :: */
  
    public function ImageConvert($request,$logoname,$namewithoutextension){
        // return $name;
    //    return asset('logos/'.$name);
    // $imagepath = 'https://logomax.com/public/logos/'.$logoname;
    $imagepath = asset('logos/'.$logoname);
    
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            // $name = 'Logo_' . rand(0, 1000) . '_' . time();
            $name = $namewithoutextension;
            $folderPath = public_path('LogoDirectory') . '/' . $name;
            $imageName = $name;
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            $jpgimagepath = $folderPath.'/'.$name.'.jpg';
            
            if (strtolower($extension) === 'eps' ||strtolower($extension) === 'ai') {
                $pdfFilePath = $folderPath . '/' . $name . '.pdf';
                $pngFilePath = $folderPath . '/' . $name . '.png';
    
                $command = "convert {$file->getPathname()} $pngFilePath";
                $output = [];
                $returnVar = null;
                exec($command, $output, $returnVar);

            }
            else {
                // Save the original image
                $file->move($folderPath, $name . '.' . $extension);
                // Convert the original image to PNG
                $this->convertAndSave($folderPath . '/' . $name . '.' . $extension, 'png');
               
            }
            // return $imageName;
            $pngImagePath = public_path('LogoDirectory') . '/' . $name .'/'.$imageName. '.png';
    
            // // // Convert the PNG image to JPG
            $this->convertAndSave($pngImagePath, 'jpg');
            $this->convertAndSave($pngImagePath, 'jpeg');
            $this->convertToPsdAndTif($pngImagePath, 'psd');
            $this->convertToPsdAndTif($pngImagePath, 'tif');
            $this->convertToPdf($pngImagePath, 'pdf');
            $this->convertToPsdAndTif($pngImagePath, 'pnm');
            $pnmImagePath = public_path('LogoDirectory') . '/' . $name .'/'.$imageName. '.pnm';
            $this->convertToSvg($pnmImagePath, 'svg');
            
            return $name;
            // echo '<pre>';
            // print_r($request->all());
            // die();
        } else {
            return 'No file provided';
        }
    }
    public function ImageConverts($request){
        if($request->hasFile('file')){
            $file = $request->file('file');
            
        // Check if the file exists
        // $imageName = 'Logo_170194998772.png';
        // $filePath = public_path('logos/' . $imageName);

        // if (!file_exists($filePath)) {
        //     return 'File not found or not accessible';
        // }
    
        // $file = new UploadedFile($filePath, $imageName);

        // return $uploadedFile;
        // $path = public_path('logos/Logo_16959893577.png');
        //     $file = Image::make($path);
        //     $file2 = json_encode($file);
        $extension = $file->getClientOriginalExtension();

        $name = 'Logo_' . rand(0, 1000) . '_' . time();
        $folderPath = public_path('LogoDirectory') . '/' . $name;
        $imageName = $name;
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        
        // return $folderPath;
        if (strtolower($extension) === 'eps' ||strtolower($extension) === 'ai') {
            
            $pdfFilePath = $folderPath . '/' . $name . '.pdf';
          
            
           exec("epstopdf {$file->getPathname()} --outfile=$pdfFilePath", $output, $retresp);
        
            if (file_exists($pdfFilePath)) {
                exec("pdftoppm $pdfFilePath $folderPath/" . $name . " -png");
                unlink($pdfFilePath);
            } else {
                return 'Error converting EPS to PDF';
            }
            $imageName = pathinfo($pdfFilePath, PATHINFO_FILENAME).'-1';
        }
        else {
            $file->move($folderPath, $name . '.' . $extension);
            $this->convertAndSave($folderPath . '/' . $name . '.' . $extension, 'png');  
        }

        $pngImagePath = public_path('LogoDirectory') . '/' . $name .'/'.$imageName. '.png';

        $this->convertAndSave($pngImagePath, 'jpg');
        $this->convertAndSave($pngImagePath, 'jpeg');
        $this->convertToPsdAndTif($pngImagePath, 'psd');
        $this->convertToPsdAndTif($pngImagePath, 'tif');
        $this->convertToPdf($pngImagePath, 'pdf');
       
    //     $this->convertToPsdAndTif($pngImagePath, 'pnm');
    //     $pnmImagePath = public_path('LogoDirectory') . '/' . $name .'/'.$imageName. '.pnm';
    //    $data = $this->convertToSvg($pnmImagePath, 'svg');

           return $name;
        // }else{
        //     return 'not';
        // }
    }

}
    public function convertAndSave($inputPath, $outputExtension)
    {
        try {
            $image = Image::make($inputPath);
            $outputPath = pathinfo($inputPath, PATHINFO_DIRNAME) . '/' . pathinfo($inputPath, PATHINFO_FILENAME) . '.' . $outputExtension;
            $image->save($outputPath);
        } catch (\Exception $e) {
            echo 'Error converting to ' . $outputExtension . ': ' . $e->getMessage();
        }
    }

    public function convertToPsdAndTif($inputPath, $outputExtension)
    {
        try {
            $optimizerChain = OptimizerChainFactory::create();
            $optimizerChain->optimize($inputPath, $inputPath);
        
            $image = ImageCow::fromFile($inputPath);
            $outputPath = pathinfo($inputPath, PATHINFO_DIRNAME) . '/' . pathinfo($inputPath, PATHINFO_FILENAME) . '.' . $outputExtension;
            $image->save($outputPath);
        } catch (\Exception $e) {
            echo 'Error converting to '.$outputExtension.': ' . $e->getMessage();
        }
    }
    public function convertToPdf($inputImagePath, $outputExtension)
    {
        try {
            // Create a new Dompdf instance
            $dompdf = new Dompdf();

            // Load the image into Dompdf
            $imageContents = file_get_contents($inputImagePath);
            $dompdf->loadHtml('<img src="data:image/jpeg;base64,' . base64_encode($imageContents) . '" />');

            // Set options
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $dompdf->setOptions($options);

            // Set paper size (optional)
            $dompdf->setPaper('A1', 'portrait');

            // Render the PDF (output as stream)
            $dompdf->render();

            // Save the PDF file
            $outputPdfPath = pathinfo($inputImagePath, PATHINFO_DIRNAME) . '/' . pathinfo($inputImagePath, PATHINFO_FILENAME) . '.' . $outputExtension;
            file_put_contents($outputPdfPath, $dompdf->output());

        } catch (\Exception $e) {
            // Handle any exceptions
            echo 'Error converting to PDF: ' . $e->getMessage();
        }
    }

    public function convertToSvg($inputImagePath, $outputExtension)
    {
        try {
            // Set the output SVG path
            $outputSvgPath = pathinfo($inputImagePath, PATHINFO_DIRNAME) . '/' . pathinfo($inputImagePath, PATHINFO_FILENAME) . '.' . $outputExtension;

            // Convert input image to a supported format (e.g., PNG)
            $convertedImagePath = pathinfo($inputImagePath, PATHINFO_DIRNAME) . '/' . pathinfo($inputImagePath, PATHINFO_FILENAME) . '.pnm';
            $convertCommand = "convert {$inputImagePath} {$convertedImagePath}";
            exec($convertCommand);

            // Use Potrace to convert the image to SVG
            $potraceCommand = "potrace --svg {$convertedImagePath} -o {$outputSvgPath}";
            exec($potraceCommand, $output, $returnVar);

            // Clean up: remove the temporary converted image
            unlink($convertedImagePath);
            return 'Potrace command output: ' . implode("\n", $output) . "\n";

            // Print the output for debugging
            echo 'Command output: ' . implode("\n", $output) . "\n";

            if ($returnVar === 0) {
                echo 'Conversion to SVG successful';
            } else {
                echo 'Error converting to SVG. Command output: ' . implode("\n", $output);
            }
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function convertImageNewApi($request,$name,$namewithoutextension){
        
        $imgurl = asset('logos/'.$name);
        // $name = $namewithoutextension;
        $folderPath = public_path('LogoDirectory') . '/' . $namewithoutextension;
        $imageName = $name;
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        if($request->hasFile('file')){
            $file = $request->file('file');
            $file->move(public_path().'/LogoDirectory/'.$namewithoutextension, $name);
        }
        $formats = ['jpg','png','pdf','svg'];
        foreach($formats as $format){
            $cloudconvert = new CloudConvert([
                'api_key' => env('CLOUDCONVERT_API_KEY'),
                'sandbox' => false
            ]);
    
                $job = (new Job())
                ->setTag('myjob-1')
                ->addTask(
                    (new Task('import/url', 'import-my-file'))
                        ->set('url',$imgurl)
                )
                ->addTask(
                    (new Task('convert', 'convert-my-file'))
                        ->set('input', 'import-my-file')
                        ->set('output_format', $format)
                        ->set('some_other_option', 'value')
                )
                ->addTask(
                    (new Task('export/url', 'export-my-file'))
                        ->set('input', 'convert-my-file')
                );
                $cloudconvert->jobs()->create($job);
    
                $cloudconvert->jobs()->wait($job); // Wait for job completion
                    foreach ($job->getExportUrls() as $file) {
    
                        $source = $cloudconvert->getHttpTransport()->download($file->url)->detach();
                        $dest = fopen(public_path('LogoDirectory/'.$namewithoutextension.'/') . $file->filename, 'w');
                        
                        stream_copy_to_stream($source, $dest);
                    }
        }
        return true;
    }

    public function deleteLogo($id){
            if($id){
                $logo = Logo::find($id);
                if($logo){
                    $media = Media::find($logo->media_id);
                    // return $media;
                    if(!$media){
                        return redirect()->back()->with('error','Something went wrong');
                    }
            
                    $filepath = public_path('LogoDirectory/'.$media->directory_name);
                    $imagepath = public_path('logos/'.$media->image_name);
                    if(is_dir($filepath)){
                        File::deleteDirectory($filepath);
                    }
                    if($imagepath){
                        File::delete($imagepath);
                    }
                    if($media){
                        $media->delete();
                        
                    }else{
                        return redirect()->back()->with('error','Something went wrong');
                    }
                    $logo->delete();
                    return redirect()->back()->with('success','Sucessfully deleted logo permanentaly');
                }else{
                    return redirect()->back()->with('error','Something went wrong'); 
                }
            }else{
                abort(404);
            }
        

    }

}
