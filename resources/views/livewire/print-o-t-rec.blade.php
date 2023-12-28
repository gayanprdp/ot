

<div>
    
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="max-w-6xl mx-auto">
        @foreach ($otlist as $item)
        @endforeach
        <div class="flex justify-end m-2 p-2 print:hidden">          
            <button onclick="window.print()" class=" bg-sky-800 hover:bg-sky-600 mx-1 text-white py-2 px-4 rounded shadow hover:shadow-xl  duration-300">Print </button>
            <x-jet-button class="bg-sky-800 hover:bg-sky-600 mx-1" wire:click="back({{$param}})">Back</x-jet-button>            
        </div>

        @if (($param2)=="r1")
            
        @else
            <div class="py-6  text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                කෘෂිකර්ම අධ්‍යක්ෂ ජනරාල්,
            </div>
        @endif

        <div class="px-6 py-3 text-center text-gray-600 dark:text-gray-300 uppercase tracking-wider">
            <u><strong>අතිකාල අයදුම්පත -{{$item->year}} {{$item->month}} මාසය සදහා</strong></u>
        </div>
        @if (($param2)=="r1")
            <div class=" py-6 text-justify text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                කෘෂිකර්ම දෙපාර්තමේන්තුවේ <strong>{{$item->institute}} </strong>ට අනුයුක්තව සේවය කරන පහත නම් සදහන් නිලධාරීන්ගේ එක් එක් නම් ඉදිරියේන් දක්වා ඇති අතිකාල දීමනා ගෙවීම් පිලිබද විස්තරය පහත දක්වමි
            </div>
        @else
            <div class=" py-6 text-justify text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                කෘෂිකර්ම දෙපාර්තමේන්තුවේ <strong>{{$item->institute}} </strong>ට අනුයුක්තව සේවය කරන පහත නම් සදහන් නිලධාරීන්ගේ එක් එක් නම් ඉදිරියේන් දක්වා ඇති අතිකාල දීමනා ගෙවීම් පිලිබද නිර්දේශය පහත දක්වමි
            </div>
        @endif


        <table  class="w-full divide-y divide-gray-200 border-solid" >
            

            <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                <tr>
                    <td scope="col" class="px-1 text-center">1</td>
                    <td scope="col" class="px-1 text-center">2</td>
                    <td scope="col" class="px-1 text-center">3</td>
                    <td scope="col" class="px-1 text-center">4</td>
                    <td scope="col" class="px-1 text-center">5</td>
                    
                    <td scope="col" class="px-1">6</td>
                    @if (($param2)!="r1")
                        <td scope="col" class="px-1">7</td>
                    @endif
                    
                  </tr>
              <tr>
                <td scope="col" class="px-1"><strong>අංක</strong></td>
                <td scope="col" class="px-1"><strong>නිලධාරියාගේ නම</strong> </td>
                <td scope="col" class="px-1"><strong>තනතුර</strong></td>
                <td scope="col" class="px-1"><strong>රාජකාරී ස්වභාවය</strong></td>
                <td scope="col" class="px-1"><strong>යෝජිත පැය ගනන</strong></td>
                @if (($param2)=="r1")
                    <td scope="col" class="px-1"><strong>අධ්‍යක්ෂ අනුමත කරන පැය ගනන</strong></td>
                @else
                    <td scope="col" class="px-1"><strong>අධ්‍යක්ෂ නිර්දේෂ කරන පැය ගනන</strong></td>
                        @if (($param2)=="r2")
                            <td scope="col" class="px-1"><strong>අධ්‍යක්ෂ (පාලන) අනුමත කරන පැය ගනන</strong></td>
                        @elseif (($param2)=="r3")
                            <td scope="col" class="px-1"><strong>අ.අ.ජ (පාලන) අනුමත කරන පැය ගනන</strong></td>
                        @endif
                @endif
              </tr>
            </thead>
            
            <?php $c=1 ?>  

            @foreach ($otrecords as $item)
                                                        
            <tr>
           
                <td class="px-2 py-1 whitespace-nowrap" valign='top'>{{$c}}</td>

                <?php $c++ ?> 
            <td class="px-2 py-1" valign='top'>{{$item->name}}</td>
            <td class="px-2 py-1" valign='top'>{{$item->desig}}</td>
            <td class="px-2 py-1" valign='top'>{{$item->Nature_of_duties}}</td>
            
            <td class="px-2 py-1 text-center" valign='top'>{{$item->suggest_ot_hour}}</td>
            <td class="px-2 py-1 text-center" valign='top'>{{$item->director_rec_ot_hour}}</td> 
            @if (($param2)!="r1")           
                <td class="px-2 py-1 text-center" valign='top'>{{$item->director_admin_rec_ot_hour}}</td>
            @endif
            
            </tr>

        @endforeach
        </table>

        @if (($param2)=="r1")
                <div class=" py-6 text-justify text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                    ඉහත අතිකාල දීමනා අනුමත කරන අතර, එක් එක් නිලධාරියා වෙනුවෙන් අනුමත කර ඇති පැය ගණන 06 වන තීරුවේ දක්වා ඇත.
                </div>

                @foreach ($ApprovedByDirector as $item)
                    <div class="grid grid-cols-2 gap-4 max-w-7xl mx-auto px-3 py-5"> 
                        <div>දිනය : {{$item->created_at}} </div>

                        <table class="border-hidden ">
                            <tr>
                                <td align="center" class="border-hidden "><img src={{ Storage::url($item->signature)}} ></td>
                            </tr>
                            <tr>
                                <td align="center" class="border-hidden ">{{$item->name}}</td>
                            </tr>
                            <tr>
                                <td align="center" class="border-hidden ">අධ්‍යක්ෂ</td>
                            </tr>
                        </table>
                        
                    </div>
                @endforeach

        @elseif (($param2)=="r2")
                <div class=" py-6 text-justify text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                    ඉහත සදහන් පරිදි අතිකාල දීමනා නිර්දේශ කර ඉදිරිපත් කරන අතර අනුමැතිය ලබාදීමට අවශ්‍ය කටයුතු සලසා දෙන මෙන් කාරුණිකව ඉල්ලා සිටිමි.
                </div>

                @foreach ($ForwardByDirector_r2 as $item)
                    <div class="grid grid-cols-2 gap-4 max-w-7xl mx-auto px-3 py-5"> 
                        <div>දිනය : {{$item->created_at}} </div>
                        
                        <table class="border-hidden ">
                            <tr>
                                <td align="center" class="border-hidden "><img src={{ Storage::url($item->signature)}}></td>
                            </tr>
                            <tr>
                                <td align="center" class="border-hidden ">{{$item->name}}</td>
                            </tr>
                            <tr>
                                <td align="center" class="border-hidden ">අධ්‍යක්ෂ</td>
                            </tr>
                        </table>

                        
                    </div>
                @endforeach
        
        @elseif (($param2)=="r3")
                <div class=" py-6 text-justify text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                    ඉහත සදහන් පරිදි අතිකාල දීමනා නිර්දේශ කර ඉදිරිපත් කරන අතර අනුමැතිය ලබාදීමට අවශ්‍ය කටයුතු සලසා දෙන මෙන් කාරුණිකව ඉල්ලා සිටිමි.
                </div>

                @foreach ($ForwardByDirector_r3 as $item)
                    <div class="grid grid-cols-2 gap-4 max-w-7xl mx-auto px-3 py-5"> 
                        <div>දිනය : {{$item->created_at}} </div>
                        
                        <table class="border-hidden ">
                            <tr>
                                <td align="center" class="border-hidden "><img src={{ Storage::url($item->signature)}} ></td>
                            </tr>
                            <tr>
                                <td align="center" class="border-hidden ">{{$item->name}}</td>
                            </tr>
                            <tr>
                                <td align="center" class="border-hidden ">අධ්‍යක්ෂ</td>
                            </tr>
                        </table>

                    </div>
                @endforeach

                
        @endif       

        <br>
            
        
        @if (($param2)=="r1")
            <hr>
            

        @endif

        @if (($param2)=="r2")
            <hr>
            <div class=" py-6 text-justify text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                ඉහත ඉල්ලීම හා නිර්දේශය අනුව අතිකාල දීමනා අනුමත කරන අතර, එක් එක් නිලධාරියා වෙනුවෙන් අනුමත කර ඇති පැය ගණන 07 වන තීරුවේ දක්වා ඇත.
            </div>

                @foreach ($ApprovedByDirectorAdmin as $item)
                    <div class="grid grid-cols-2 gap-4 max-w-7xl mx-auto px-3 py-5"> 
                        <div>දිනය : {{$item->created_at}} </div>

                        <table class="border-hidden ">
                            <tr>
                                <td align="center" class="border-hidden "><img src={{ Storage::url($item->signature)}} ></td>
                            </tr>
                            <tr>
                                <td align="center" class="border-hidden ">{{$item->name}}</td>
                            </tr>
                            <tr>
                                <td align="center" class="border-hidden ">අධ්‍යක්ෂ පාලන</td>
                            </tr>
                            <tr>
                                <td align="center" class="border-hidden ">කෘෂිකර්ම අධ්‍යක්ෂ ජනරාල් වෙනුවට</td>
                            </tr>
                        </table>

                        
                    </div>
                @endforeach

        @endif

        @if (($param2)=="r3")
            <hr>
            <div class=" py-6 text-justify text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                ඉහත ඉල්ලීම හා නිර්දේශය අනුව අතිකාල දීමනා අනුමත කරන අතර, එක් එක් නිලධාරියා වෙනුවෙන් අනුමත කර ඇති පැය ගණන 07 වන තීරුවේ දක්වා ඇත.
            </div>

            
                @foreach ($ApprovedByADG as $item)
                    <div class="grid grid-cols-2 gap-4 max-w-7xl mx-auto px-3 py-5"> 
                        <div>දිනය : {{$item->created_at}} </div>
                        <table class="border-hidden ">
                            <tr>
                                <td align="center" class="border-hidden "><img src={{ Storage::url($item->signature)}} ></td>
                            </tr>
                            <tr>
                                <td align="center" class="border-hidden ">{{$item->name}}</td>
                            </tr>
                            <tr>
                                <td align="center" class="border-hidden ">අතිරේක අධ්‍යක්ෂ ජනරාල් පාලන</td>
                            </tr>
                            <tr>
                                <td align="center" class="border-hidden ">කෘෂිකර්ම අධ්‍යක්ෂ ජනරාල් වෙනුවට</td>
                            </tr>
                        </table>
                        
                    </div>
                @endforeach
                
            
        @endif


        
        
    </div>

     
</div>   


    
 
<style>
    table, th, td {
        border: 1px solid black;
       
       
      }

   
  </style>
