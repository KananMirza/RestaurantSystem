var regex = /[+-]?\d+(\.\d+)?/g;
const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var price;
onload = () => {
    if (localStorage.getItem('userId') === null) {
        localStorage.setItem('userId', UniqueID());
    }
    //delete localStorage.userCard;
    if (localStorage.getItem('userCard') === null) {
        var Card = {
            userId: localStorage.getItem('userId'),
            Foods: [],
            Category: [],
            Count: [],
            Properties: [],
            Prices: [],
            Images: [],
            Notes: [],
            total: 0
        };
        localStorage.setItem('userCard', JSON.stringify(Card));
    } else {
        countView();
        viewCardData();
    }
};
const Sum = () => {

    const properties_value = document.getElementById("properties_view").value > 0 ? document.getElementById("properties_view").value :
        Number(document.getElementById('price_view').textContent.match(regex).map(function (v) {
            return parseFloat(v);
        })).toFixed(2);
    const count = document.getElementById("count").value;
    document.getElementById("sum_td").innerText = (properties_value * count).toFixed(2) + " AZN";
};

const AddProduct = () => {
    let Card = JSON.parse(localStorage.userCard);
    let propertiesOpt = document.getElementById('properties_view');
     if (Card.Foods.includes(propertiesOpt.options[propertiesOpt.selectedIndex].text) && propertiesOpt.options[propertiesOpt.selectedIndex].text !== "Seçim edə bilərsiniz..") {
        console.log(2);
        let k = Card.Foods.indexOf(propertiesOpt.options[propertiesOpt.selectedIndex].text);
        Card.Count[k] = Card.Count[k] + Number(document.getElementById('count').value);
        price = Number(document.getElementById("properties_view").value);
        Card.Prices[k] = price;
        Card.total += Number(price * Number(document.getElementById('count').value));
    } else if (Card.Foods.includes(document.getElementById('name_view').textContent) && propertiesOpt.options[propertiesOpt.selectedIndex].text === "Seçim edə bilərsiniz.."){
        console.log(1);
        let k = Card.Foods.indexOf(document.getElementById('name_view').textContent);
        Card.Count[k] = Card.Count[k] + Number(document.getElementById('count').value);
        if (document.getElementById("properties_view").value === "") {
            console.log(1.1);
            price = Number(document.getElementById('price_view').textContent.match(regex).map(function (v) {
                return parseFloat(v);
            })).toFixed(2);
        } else {
            console.log(1.2);
            price = Number(document.getElementById("properties_view").value);
        }
        Card.Prices[k] = price;
        Card.total += Number(price * Number(document.getElementById('count').value));
    } else {
        console.log(3);
        Card.Category.push(document.getElementById('category_view').textContent);
        Card.Count.push(Number(document.getElementById('count').value));
        Card.Properties.push(propertiesOpt.options[propertiesOpt.selectedIndex].text);
        if (document.getElementById("properties_view").value === "") {
            console.log(3.1);
            Card.Foods.push(document.getElementById('name_view').textContent);
            price = Number(document.getElementById('price_view').textContent.match(regex).map(function (v) {
                return parseFloat(v);
            })).toFixed(2);
        } else {
            console.log(3.2);
            Card.Foods.push(propertiesOpt.options[propertiesOpt.selectedIndex].text);
            price = Number(document.getElementById("properties_view").value);
        }

        Card.Prices.push(price);
        Card.Images.push(document.getElementById('img_view').src);
        Card.Notes.push(document.getElementById('note').value);

        Card.total += Number(price * Number(document.getElementById('count').value));
    }

    localStorage.userCard = JSON.stringify(Card);
    countView();
    viewCardData();
};


const UniqueID = () => {
    return '_' + Math.random().toString(36).substr(2, 9);
};


const countView = () => {
    let Card = JSON.parse(localStorage.userCard);
    let count = Card.Foods.length;
    document.getElementsByClassName('card-count')[0].innerHTML = count;
    localStorage.userCard = JSON.stringify(Card);
};

const viewCardData = () => {

    let Card = JSON.parse(localStorage.userCard);
    console.log(Card);
    let count = Card.Foods.length;
    let data = ``;
    for (let i = 0; i < (count > 5 ? 5 : count); i++) {
        data += `  <li>
                            <a class="text-dark media py-2" href="javascript:void(0)">
                                <div class="mx-3">
                                    <i class="fa fa-fw fa-check-circle text-success"></i>
                                </div>
                                <div class="media-body font-size-sm pr-2">
                                    <div class="font-w600">${Card.Foods[i]} x ${Card.Count[i]}</div>
                                    <div class="text-muted font-italic">${(Card.Prices[i] * Card.Count[i]).toFixed(2)} AZN</div>
                                </div>
                            </a>
                        </li>`;
    }

    document.getElementsByClassName("nav-items")[0].innerHTML = data;

    localStorage.userCard = JSON.stringify(Card);
};

const viewSearch = ()=>{
    let input, filter, search, txtValue;
    input = document.getElementsByClassName('input')[0];
    search = document.getElementsByClassName('search');
    filter = input.value.toUpperCase();
    for (let i = 0; i < search.length; i++) {
        let name = document.getElementsByClassName('name')[i];
        if (input) {
            txtValue = name.textContent || name.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                search[i].style.display = "";
            } else {
                search[i].style.display = "none";
            }
        }
    }
}

const viewAll = ()=>{
    $("#overlay").fadeIn();
    let Card = JSON.parse(localStorage.userCard);
    let body = document.getElementById('tbody');
    let tr = "";
    for (let i =0;i<Card.Foods.length;i++){
        tr += `
        <tr>
                            <td><img src="${Card.Images[i]}" style="width: 100px;height: 100px" ></td>
                            <td>${Card.Foods[i]}</td>
                            <td>${Card.Prices[i]} AZN</td>
                            <td>${Card.Count[i]}</td>
                            <td>${(Card.Prices[i]*Card.Count[i]).toFixed(2)} AZN</td>
                            <td><textarea value="" class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>${Card.Notes[i]}</textarea></td>
                            <td><button class="btn btn-outline-danger" onclick="deleteItem(${i})">Məhsulu Sil</button></td>
                        </tr>
        `
    }
    document.getElementById('total').innerText = `Ümumi Qiymət: ${Card.total.toFixed(2)} AZN`
    body.innerHTML = tr;

    $("#viewAll").modal("show")
    $("#overlay").fadeOut(300);
}

const deleteItem = (id)=>{

                let Card = JSON.parse(localStorage.userCard);
                Card.Category.splice(id,1);
                Card.Foods.splice(id,1);
                Card.Images.splice(id,1);
                Card.Notes.splice(id,1);
                Card.Properties.splice(id,1);
                Card.total = Card.total - Number(Card.Prices[id] *  Card.Count[id]);
                Card.Prices.splice(id,1);
                Card.Count.splice(id,1);

                localStorage.userCard = JSON.stringify(Card);
                viewAll();
                countView();


}

const confirmOrder = () =>{
    document.getElementById('confirm').innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  <span class="visually-hidden">Təsdiqlənir...</span>`;

    let Card = JSON.parse(localStorage.userCard);
    const sub = Card.total;

    $.ajax({
        type: "POST",
        url: "/food/order/add",
        data: {
            _token: CSRF_TOKEN,
            sub: sub,
            Card : Card,
        },
        success: async function (data) {
            if(data==="1") {
                delete localStorage.userCard;
                swal("Uğurlu!", "Sifariş alındı!", "success");
                location.reload();
            }
            else{
                swal("Gözlənilməyən xəta baş verdi!");
                localStorage.userCard = JSON.stringify(Card);
            }
        },
        error: function () {
            alert('Error... 5000');
            localStorage.userCard = JSON.stringify(Card);
        }
    })


};



