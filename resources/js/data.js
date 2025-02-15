import './bootstrap';
import { Notyf } from 'notyf';
import "@fortawesome/fontawesome-free/css/all.min.css";
import 'notyf/notyf.min.css'; // for React,

const notyf = new Notyf();

window.onload = () => {
  loadPrefecture();
  loadYear();

  document.getElementById('btnSearch').addEventListener('click', loadPopulationData);
};

const setLoadingPrefectures = (loading) => {
  const select = document.querySelector('#selectPrefecture');
  const load = document.querySelector('#divSelectPrefecture .skeleton');
  if (loading) {
    select.classList.add('hidden');
    load.classList.remove('hidden');
    document.getElementById('selectPrefecture').attributes.disabled = true;
  } else {
    select.classList.remove('hidden');
    load.classList.add('hidden');
    document.getElementById('selectPrefecture').attributes.disabled = false;
  }
}

const loadPrefecture = async () => {
  const select = document.getElementById('selectPrefecture');
  setLoadingPrefectures(true);
  try {
    const response = await fetch("prefectures");
    const result = await response.json();
    if (!result.error) {
      select.innerHTML = '';
      const option = document.createElement('option');
      option.value = '';
      option.text = 'Select a prefecture';
      select.appendChild(option);

      result.data.forEach(prefecture => {
        const option = document.createElement('option');
        option.value = prefecture.id;
        option.text = prefecture.name;
        select.appendChild(option);
      });
      setLoadingPrefectures(false);
    } else {
      notyf.error(result.message);
    }
    setLoadingPrefectures(false);
  } catch (error) {
    setLoadingPrefectures(false);
    notyf.error(error);
  }
}

const setLoadingYears = (loading) => {
  const select = document.querySelector('#selectYear');
  const load = document.querySelector('#divSelectYear .skeleton');
  if (loading) {
    select.classList.add('hidden');
    load.classList.remove('hidden');
    document.getElementById('selectYear').attributes.disabled = true;
  } else {
    select.classList.remove('hidden');
    load.classList.add('hidden');
    document.getElementById('selectYear').attributes.disabled = false;
  }
}

const loadYear = async () => {
  const select = document.getElementById('selectYear');
  setLoadingYears(true);
  try {
    const response = await fetch("years");
    const result = await response.json();
    if (!result.error) {
      select.innerHTML = '';
      const option = document.createElement('option');
      option.value = '';
      option.text = 'Select a year';
      select.appendChild(option);

      result.data.forEach(year => {
        const option = document.createElement('option');
        option.value = year.id;
        option.text = year.name;
        select.appendChild(option);
      });
      setLoadingYears(false);
    } else {
      notyf.error(result.message);
    }
    setLoadingYears(false);
  } catch (error) {
    setLoadingYears(false);
    notyf.error(error.message);
  }
}

const setLoadingPopulation = (loading) => {
  const btn = document.getElementById('btnSearch');

  if (loading) {
    btn.disabled = true;
    btn.innerHTML = '<span class="loading loading-spinner text-primary-content"></span>';
  } else {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa-solid fa-search"></i><div>Search population data</div>';
  }
}

const loadPopulationData = async () => {
  const prefecture = document.getElementById('selectPrefecture').value;
  const year = document.getElementById('selectYear').value;
  if (!prefecture || !year) {
    notyf.error('You must select a prefecture and a year');
    return;
  }

  setLoadingPopulation(true);
  try {
    const response = await fetch(`population?prefecture_id=${prefecture}&year_id=${year}`);
    const result = await response.json();

    if (!result.error) {
      fillPopulationData(result.data);
    } else {
    notyf.error(result.message);
    }

    setLoadingPopulation(false);
  } catch (error) {
    setLoadingPopulation(false);
    notyf.error(error.message);
  }
}

const fillPopulationData = (data) => {
  const div = document.getElementById('populationDiv');
  div.classList.remove('h-0');
  div.classList.add('h-[200px]');

  const content = document.querySelector('#populationDiv *');
  content.classList.remove('opacity-0');
  content.classList.add('opacity-100');

  const title = document.getElementById('populationTitle');
  title.innerHTML = `Population in ${data.prefecture.name} in ${data.year.name} is :`;

  const value = document.getElementById('populationValue');
  value.innerHTML = formatNumber(data.value);
}

const formatNumber = (number) => {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
