<div id="con">

	<div class="wrap store">
    	<div>	
			<span class="red">*</span> 거래처 : 
            <select>
            	<option value="">거래처선택</option>  
            </select>
            &nbsp;&nbsp;&nbsp;&nbsp;
            
            <span class="red">*</span> 제품명 : 
            <select>
            	<option value="">제품선택</option>
            </select>
            &nbsp;&nbsp;&nbsp;&nbsp;
            
            <span class="red">*</span> 제품개수 : <input type="text" style="width:70px;" > 
            &nbsp;&nbsp;&nbsp;&nbsp;
            
            <span class="red">*</span> 출고날짜 : <input type="text" id="in_date" style="width:150px; text-align:center;">
              &nbsp;&nbsp;&nbsp;&nbsp;
            <button>출고하기</button>
        </div>

        <div class="in_search">
        	
        	거래처 : 
            <select>
            	<option>전 체</option>
            </select>
            
            &nbsp;&nbsp;&nbsp;&nbsp;
            
            제품별 : 
            <select>
            	<option>전 체</option>
            </select>
            
             &nbsp;&nbsp;&nbsp;&nbsp;
             
             시작날짜 : <input type="text" id="s_date" style="width:150px; text-align:center;">
             
             &nbsp;&nbsp;&nbsp;&nbsp;
            
             마지막날짜 : <input type="text" id="e_date" style="width:150px; text-align:center;">
             
             &nbsp;&nbsp;&nbsp;&nbsp;
 			 <button>검색하기</button>     
        </div>
        <div class="s_list" >
        
        	<div class="se_re">
            	"거래처 : <span class="red"></span>", &nbsp; "제품명 : <span class="red"></span>", &nbsp; 
            	"시작날짜 : <span class="red">이상</span>",   &nbsp;  "마지막날짜 : <span class="red"> 이하</span>" 
            </div>
            <div class="se_re2"> 
           		총 <span class="red"></span> 건, 전체마진 <span class="red"></span> 원,
            	전체출고총액 : <span class="red"></span> 원
            </div>
        	
        	<table class="list mat40">
            	<tr>
                	<th>거래처</th>
                    <th>제품명</th>
                    <th>출고개수(총개수)</th>
                    <th>입고가</th>
                    <th>출고가</th>
                    <th>마 진</th>
                    <th>출고총액</th>
                    <th>출고날짜</th>
    
                </tr>

                <tr>
                	<td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr> 
            </table>
  
            <div class="w100 ac mat20">
        	
                <button>이전</button>
    
                <button>1</button>

                <button>다음</button>

        	</div>
            
        </div>
	</div>
</div>